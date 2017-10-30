<?php

namespace App\Http\Controllers\Mobile;

use App\Farmer\Models\MobileMessage;
use App\Farmer\Models\Protocol\Device;
use App\Http\Controllers\Controller;
use App\Jobs\ProcessUpload;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('api');
    }

    /**
     * Retrieve new messages for a given device.
     *
     * @param Request $request Containing device uuid
     * @return mixed Collection of new messages
     */
    public function messages(Request $request)
    {
        // here uuid is lowercase on upload is still capitalized in future versions change it to lowercase too
        $data = $request->validate([
            'uuid' => 'required',
            'message' => 'required',
        ]);

        $device = Device::where('uuid', $data['uuid'])->firstOrFail();

        return MobileMessage::where('id', '>', $data['message'])
            ->where(function ($query) use ($device) {
                $query->where('recipient', 0)->orWhere('recipient', $device->id);
            })
            ->get();
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'uuId' => 'required',
            'model' => 'required',
            'manufacturer' => 'required',
            'brand' => 'required',
            'product' => 'required',
            'osVersion' => 'required',
            'kernelVersion' => 'required',
            'isRoot' => 'required',
        ]);

        $exists = Device::where('uuid', $data['uuId'])->first();
        if ($exists != null) {
            return 0;
        }

        $device = Device::create([
            'uuid' => $data['uuId'],
            'model' => $data['model'],
            'manufacturer' => $request->manufacturer,
            'brand' => $request->brand,
            'product' => $request->product,
            'os_version' => $request->osVersion,
            'kernel_version' => $request->kernelVersion,
            'is_root' => $request->isRoot,
        ]);

        return $device->id;
    }

    public function upload(Request $request)
    {
        $data = $request->validate([
            'sample' => 'required',
        ]);

        // Find device
        $device = Device::where('uuid', $data['sample']['uuId'])->first();

        // dispatch job with device
        $job = (new ProcessUpload($device, $data['sample']))->delay(Carbon::now()->addSeconds(5));
        dispatch($job);

        return ($device == null) ? 0 : 1;
    }
}
