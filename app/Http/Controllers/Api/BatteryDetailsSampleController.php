<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SampleResource;
use App\Farmer\Models\Protocol\BatteryDetails;

class BatteryDetailsSampleController extends Controller
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
     * @param BatteryDetails $batteryDetails
     *
     * @return SampleResource
     */
    public function index(BatteryDetails $batteryDetails)
    {
        return new SampleResource($batteryDetails->sample);
    }
}
