<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Farmer\Models\Protocol\Sample;
use App\Http\Resources\DeviceResource;

class SamplesDeviceController extends Controller
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
     * @param Sample $sample
     * @return DeviceResource
     */
    public function index(Sample $sample)
    {
        return new DeviceResource($sample->device);
    }
}
