<?php

namespace App\Http\Controllers\Api;

use App\Farmer\Models\Protocol\BatteryDetails;
use App\Http\Resources\BatteryDetailsResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BatteryDetailsController extends Controller
{
    protected $perPage = 10;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        if ($request->has('per_page')) {
            $this->perPage = $request->per_page;
        }

        return BatteryDetailsResource::collection(BatteryDetails::simplePaginate($this->perPage));
    }

    /**
     * Display the specified resource.
     *
     * @param  BatteryDetails $batteryDetails
     * @return BatteryDetailsResource
     */
    public function show(BatteryDetails $batteryDetails)
    {
        return new BatteryDetailsResource($batteryDetails);
    }
}
