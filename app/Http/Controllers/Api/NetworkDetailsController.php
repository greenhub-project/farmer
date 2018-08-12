<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Farmer\Models\Protocol\NetworkDetails;
use App\Http\Resources\NetworkDetailsResource;

class NetworkDetailsController extends Controller
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
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        if ($request->has('per_page')) {
            $this->perPage = $request->per_page;
        }

        return NetworkDetailsResource::collection(NetworkDetails::simplePaginate($this->perPage));
    }

    /**
     * Display the specified resource.
     *
     * @param NetworkDetails $networkDetails
     * @return NetworkDetailsResource
     */
    public function show(NetworkDetails $networkDetails)
    {
        return new NetworkDetailsResource($networkDetails);
    }
}
