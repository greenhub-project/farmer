<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Jobs\ProcessNewUpload;
use App\Farmer\Models\MobileMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Farmer\Models\Protocol\Device;

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
     *
     * @return mixed Collection of new messages
     */
    public function messages(Request $request)
    {
        // here uuid is lowercase on upload is still capitalized in future versions change it to lowercase too
        $attributes = $request->validate([
            'uuid' => 'required',
            'message' => 'required',
        ]);

        $device = Device::where('uuid', $attributes['uuid'])->firstOrFail();

        return MobileMessage::where('id', '>', $attributes['message'])
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
        if (null != $exists) {
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

        Redis::incr('devices:count:' . today()->toDateString());

        return $device->id;
    }

    public function upload(Request $request)
    {
        $data = $request->validate([
            'sample' => 'required',
        ]);

        // Find device
        $device = Device::where('uuid', $data['sample']['uuId'])->first();

        if (is_null($device)) {
            \Log::error('Device with uuId:'.$data['sample']['uuId'].'not found');
        }

        // dispatch job with device
        dispatch(new ProcessNewUpload($device, $data['sample']));

        return (null == $device) ? 0 : 1;
    }
}
