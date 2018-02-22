<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SampleResource;
use App\Farmer\Models\Protocol\BatteryDetails;

class BatteryDetailsSampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param BatteryDetails $batteryDetails
     * @return SampleResource
     */
    public function index(BatteryDetails $batteryDetails)
    {
        return new SampleResource($batteryDetails->sample);
    }
}
