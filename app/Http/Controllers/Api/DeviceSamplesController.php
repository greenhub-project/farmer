<?php

namespace App\Http\Controllers\Api;

use App\Farmer\Models\Protocol\Device;
use App\Http\Controllers\Controller;
use App\Http\Resources\SampleResource;

class DeviceSamplesController extends Controller
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
     * @param \App\Farmer\Models\Protocol\Device $device
     * @return \Illuminate\Http\Response
     */
    public function index(Device $device)
    {
        return SampleResource::collection($device->samples()->simplePaginate());
    }
}
