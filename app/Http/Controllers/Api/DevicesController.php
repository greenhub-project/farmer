<?php

namespace App\Http\Controllers\Api;

use App\Farmer\Models\Protocol\Device;
use App\Http\Controllers\Controller;
use App\Http\Resources\DeviceResource;

class DevicesController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DeviceResource::collection(Device::simplePaginate());
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Farmer\Models\Protocol\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        return DeviceResource::make($device);
    }
}
