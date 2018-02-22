<?php

namespace App\Http\Controllers\Api;

use App\Farmer\Models\Protocol\Device;
use App\Http\Controllers\Controller;
use App\Http\Resources\SampleResource;
use Illuminate\Http\Request;

class DeviceSamplesController extends Controller
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
     * @param \App\Farmer\Models\Protocol\Device $device
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Device $device, Request $request)
    {
        if ($request->has('per_page')) {
            $this->perPage = $request->per_page;
        }

        return SampleResource::collection($device->samples()->simplePaginate($this->perPage));
    }
}
