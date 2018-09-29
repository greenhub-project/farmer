<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Farmer\Models\Protocol\Device;
use App\Http\Resources\DeviceResource;

class DevicesController extends Controller
{
    protected $perPage = 10;

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
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        if ($request->has('per_page')) {
            $this->perPage = $request->per_page;
        }

        return DeviceResource::collection(Device::simplePaginate($this->perPage));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Farmer\Models\Protocol\Device $device
     *
     * @return DeviceResource
     */
    public function show(Device $device)
    {
        return new DeviceResource($device);
    }
}
