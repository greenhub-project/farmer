<?php

namespace App\Http\Controllers\Api;

use App\Farmer\Models\Protocol\Device;
use App\Farmer\Models\Protocol\Sample;
use App\Http\Controllers\Controller;
use App\Http\Resources\DeviceResource;
use App\Http\Resources\SampleResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QueriesController extends Controller
{
    private $availableModels = [
        'devices',
        'samples'
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function count($model, Request $request)
    {
        if (! in_array($model, $this->availableModels)) {
            return json_encode([
                'errors' => ['Unknown model']
            ]);
        }

        $query = \DB::table($model);
        $filters = json_decode($request->filters);

        if (sizeof($filters) > 0) {
            $columns = \Schema::getColumnListing($model);
            // No parameters, check for any filters now
            switch ($model) {
                case 'devices':
                    foreach ($filters as $key => $val) {
                        $key = str_replace('os', 'os_version', $key);
                        if (! in_array($key, $columns)) continue;
                        $query->where($key, $val);
                    }
                    break;
                case 'samples':
                    $query->leftJoin('devices', 'samples.device_id', '=', 'devices.id');
                    $extra_columns = \Schema::getColumnListing('devices');
                    $columns = array_merge($columns, $extra_columns);

                    foreach ($filters as $key => $val) {
                        $key = str_replace('os', 'os_version', $key);
                        if (! in_array($key, $columns)) continue;
                        $query = $query->where($key, $val);
                    }
                    break;
            }
        }

        // Has date parameters
        if ($request->has('date')) {
            $date = Carbon::parse($request->date);
            $query->whereDate($model . '.created_at', $date);
        }

        // Has last parameters
        if ($request->has('last')) {
            $date = Carbon::now();
            $value = intval(substr($request->last, 0, -1));
            $interval = substr($request->last, -1);

            switch ($interval) {
                case 'm':
                    $date = $date->subMonths($value);
                    break;
                case 'w':
                    $date = $date->subWeeks($value);
                    break;
                case 'd':
                    $date = $date->subDays($value);
                    break;
                case 'h':
                    $date = $date->subHours($value);
                    break;
                default:
                    return json_encode([
                        'errors' => ['Invalid time interval']
                    ]);
            }

            $query->where($model . '.created_at', '>=', $date);
        }

        // Has range parameters
        if ($request->has('date_begin') and $request->has('date_end')) {
            // Contains both begin and end dates
            $begin = Carbon::parse($request->date_begin);
            $end = Carbon::parse($request->date_end);

            $query->whereBetween($model . '.created_at', [$begin, $end]);
        }

        if ($request->has('date_begin')) {
            // Contains only begin date
            $begin = Carbon::parse($request->date_begin);
            $query->where($model . '.created_at', '>=', $begin);
        }

        if ($request->has('date_end')) {
            // Contains only end date
            $end = Carbon::parse($request->date_end);
            $query->where($model . '.created_at', '<=', $end);
        }

        return json_encode([
            'total' => $query->count()
        ]);
    }

    public function models(Request $request)
    {
        return json_encode([
            'data' => $this->availableModels
        ]);
    }

    public function devices(Request $request)
    {
        // Get the filters and per page args
        $builder = null;
        $filters = $request->has('filters') ? json_decode($request->filters) : [];
        $perPage = $request->has('per_page') ? $request->per_page : 10;

        // Query through any existing filters
        if (sizeof($filters) > 0) {
            $columns = \Schema::getColumnListing('devices');
            // No parameters, check for any filters now
            foreach ($filters as $key => $val) {
                $key = str_replace('os', 'os_version', $key);
                $key = str_replace('kernel', 'kernel_version', $key);

                if (! in_array($key, $columns)) continue;

                $builder = is_null($builder) ? Device::where($key, $val) : $builder->where($key, $val);
            }
        }

        // Has date parameters -d --date
        if ($request->has('date')) {
            $date = Carbon::parse($request->date);

            $builder = is_null($builder) ? Device::whereDate('created_at', $date) :
                $builder->whereDate('created_at', $date);
        }

        // Has last parameters -L --last
        if ($request->has('last')) {
            $date = Carbon::now();
            $value = intval(substr($request->last, 0, -1));
            $interval = substr($request->last, -1);

            switch ($interval) {
                case 'm':
                    $date = $date->subMonths($value);
                    break;
                case 'w':
                    $date = $date->subWeeks($value);
                    break;
                case 'd':
                    $date = $date->subDays($value);
                    break;
                case 'h':
                    $date = $date->subHours($value);
                    break;
                default:
                    return json_encode([
                        'errors' => ['Invalid time interval']
                    ]);
            }

            $builder = is_null($builder) ? Device::where('created_at', '>=', $date) :
                $builder->where('created_at', '>=', $date);
        }

        // Has range parameters -R --range
        if ($request->has('date_begin') and $request->has('date_end')) {
            // Contains both begin and end dates
            $begin = Carbon::parse($request->date_begin);
            $end = Carbon::parse($request->date_end);

            $builder = is_null($builder) ? Device::whereBetween('created_at', [$begin, $end]) :
                $builder->whereBetween('created_at', [$begin, $end]);
        }

        if ($request->has('date_begin')) {
            // Contains only begin date
            $begin = Carbon::parse($request->date_begin);

            $builder = is_null($builder) ? Device::where('created_at', '>=', $begin) :
                $builder->where('created_at', '>=', $begin);
        }

        if ($request->has('date_end')) {
            // Contains only end date
            $end = Carbon::parse($request->date_end);

            $builder = is_null($builder) ? Device::where('created_at', '<=', $end) :
                $builder->where('created_at', '<=', $end);
        }

        // If command export has called return a download response instead
        if ($request->has('export')) {
            $builder = is_null($builder) ? Device::all() : $builder->get();
            $data = $builder->toArray();

            $filename = 'csv/query_' . Carbon::now()->toDateTimeString() . '.csv';
            $path = storage_path('app/public/' . $filename);
            \Storage::disk('public')->put($filename, '');

            $fp = fopen($path, 'w');
            fputcsv($fp, array_keys($data[0])); // TODO: Extract from resource

            foreach ($data as $fields) {
                fputcsv($fp, $fields);
            }

            fclose($fp);

            return response()->download($path, 'output.csv')->deleteFileAfterSend(true);
        }

        // Load every model relationship or just specified ones
        if ($request->has('everything')) {
            $builder = is_null($builder) ? Device::with('samples') : $builder->with('samples');
        } elseif ($request->has('with')) {
            $builder = is_null($builder) ? Device::with($request->with) : $builder->with($request->with);
        }

        // Load every result in a single output or paginate results
        if ($request->has('all')) {
            $builder = is_null($builder) ? Device::all() : $builder->get();
        } else {
            $builder = is_null($builder) ? Device::paginate($perPage) : $builder->paginate($perPage);
        }

        return DeviceResource::collection($builder);
    }

    public function samples(Request $request)
    {
        if (! $request->has('cli')) return [];

        // Get the filters and per page args
        $builder = null;
        $filters = $request->has('filters') ? json_decode($request->filters) : [];
        $perPage = $request->has('per_page') ? $request->per_page : 10;

        // Query through any existing filters
        if (sizeof($filters) > 0) {
            $columns = array_merge(
                \Schema::getColumnListing('samples'),
                \Schema::getColumnListing('devices')
            );

            // No parameters, check for any filters now
            foreach ($filters as $key => $val) {
                $key = str_replace('os', 'os_version', $key);
                $key = str_replace('kernel', 'kernel_version', $key);

                if (! in_array($key, $columns)) continue;

                if (is_null($builder)) {
                    $builder = Sample::whereHas('device', function($query) use ($key, $val) {
                        $query->where($key, $val);
                    });
                } else {
                    $builder = $builder->whereHas('device', function($query) use ($key, $val) {
                        $query->where($key, $val);
                    });
                }
            }
        }

        // Has date parameters
        if ($request->has('date')) {
            $date = Carbon::parse($request->date);

            $builder = is_null($builder) ? Sample::whereDate('created_at', $date) :
                $builder->whereDate('created_at', $date);
        }

        // Has last parameters
        if ($request->has('last')) {
            $date = Carbon::now();
            $value = intval(substr($request->last, 0, -1));
            $interval = substr($request->last, -1);

            switch ($interval) {
                case 'm':
                    $date = $date->subMonths($value);
                    break;
                case 'w':
                    $date = $date->subWeeks($value);
                    break;
                case 'd':
                    $date = $date->subDays($value);
                    break;
                case 'h':
                    $date = $date->subHours($value);
                    break;
                default:
                    return json_encode([
                        'errors' => ['Invalid time interval']
                    ]);
            }

            $builder = is_null($builder) ? Sample::where('created_at', '>=', $date) :
                $builder->where('created_at', '>=', $date);
        }

        // Has range parameters
        if ($request->has('date_begin') and $request->has('date_end')) {
            // Contains both begin and end dates
            $begin = Carbon::parse($request->date_begin);
            $end = Carbon::parse($request->date_end);

            $builder = is_null($builder) ? Sample::whereBetween('created_at', [$begin, $end]) :
                $builder->whereBetween('created_at', [$begin, $end]);
        }

        if ($request->has('date_begin')) {
            // Contains only begin date
            $begin = Carbon::parse($request->date_begin);

            $builder = is_null($builder) ? Sample::where('created_at', '>=', $begin) :
                $builder->where('created_at', '>=', $begin);
        }

        if ($request->has('date_end')) {
            // Contains only end date
            $end = Carbon::parse($request->date_end);

            $builder = is_null($builder) ? Sample::where('created_at', '<=', $end) :
                $builder->where('created_at', '<=', $end);
        }

        // If command export has called return a download response instead
        if ($request->has('export')) {
            \Log::info('Got to export samples part...');
            $builder = is_null($builder) ? Sample::all() : $builder->get();
            $data = $builder->toArray();

            $filename = 'csv/query_' . Carbon::now()->toDateTimeString() . '.csv';
            $path = storage_path('app/public/' . $filename);
            \Storage::disk('public')->put($filename, '');

            $fp = fopen($path, 'w');
            fputcsv($fp, array_keys($data[0])); // TODO: Extract from resource

            foreach ($data as $fields) {
                fputcsv($fp, $fields);
            }

            fclose($fp);

            return response()->download($path, 'output.csv')->deleteFileAfterSend(true);
        }

        // Load every model relationship or just specified ones
        if ($request->has('everything')) {
            $builder = is_null($builder) ? Sample::withAll() : $builder->withAll();
        } elseif ($request->has('with')) {
            $builder = is_null($builder) ? Sample::with($request->with) :
                $builder->with($request->with);
        }

        // Load every result in a single output or paginate results
        if ($request->has('all')) {
            $builder = is_null($builder) ? Sample::all() : $builder->get();
        } else {
            $builder = is_null($builder) ? Sample::paginate($perPage) : $builder->paginate($perPage);
        }

        return SampleResource::collection($builder);
    }
}
