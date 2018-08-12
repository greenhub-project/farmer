<?php

namespace App\Http\Controllers\Api;

use App\Farmer\Models\Protocol\NetworkDetails;
use App\Http\Controllers\Controller;
use App\Http\Resources\SampleResource;

class NetworkDetailsSampleController extends Controller
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
     * @param NetworkDetails $networkDetails
     * @return SampleResource
     */
    public function index(NetworkDetails $networkDetails)
    {
        return new SampleResource($networkDetails->sample);
    }
}
