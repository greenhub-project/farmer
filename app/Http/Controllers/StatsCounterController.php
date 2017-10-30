<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class StatsCounterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Count records from given model per interval of time.
     *
     * @param string $model model name
     * @param Request $request interval parameter
     * @return int count number
     */
    public function count($model, Request $request)
    {
        $today = Carbon::today();

        $data = $request->validate([
            'interval' => 'required',
        ]);

        switch ($data['interval']) {
            case 'today':
                return \DB::table($model)->where('created_at', '>=', $today)->count();
            case 'week':
                return \DB::table($model)->where('created_at', '>=', $today->startOfWeek())->count();
            case 'month':
                return \DB::table($model)->where('created_at', '>=', $today->startOfMonth())->count();
        }

        return 0;
    }

    /**
     * Count number of records of last 7 days
     * from given model and group them by date.
     *
     * @param string $model model name
     * @param Request $request
     * @return array
     */
    public function weekly($model, Request $request)
    {
        $today = Carbon::today();

        $params = $request->validate([
            'device' => 'nullable',
        ]);

        $data = \DB::table($model)
            ->selectRaw('count(*) as total, DATE(created_at) as day')
            ->where('created_at', '>=', $today->subWeek())
            ->groupBy('day')
            ->get();

        $data->map(function ($elem) {
            $elem->day = Carbon::parse($elem->day)->format('d M');
            return $elem;
        });

        return json_encode($data);
    }

    /**
     * Count total number of records from given model.
     *
     * @param string $model model name
     * @return int total number
     */
    public function total($model)
    {
        return \DB::table($model)->count();
    }
}
