<?php

namespace App\Http\Controllers\Api;

use App\Farmer\Models\Protocol\Sample;
use App\Http\Controllers\Controller;
use App\Http\Resources\SampleResource;
use Illuminate\Http\Request;

class SamplesController extends Controller
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
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        if ($request->has('per_page')) {
            $this->perPage = $request->per_page;
        }

        return SampleResource::collection(Sample::simplePaginate($this->perPage));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Farmer\Models\Protocol\Sample $sample
     *
     * @return SampleResource
     */
    public function show(Sample $sample)
    {
        return new SampleResource($sample);
    }
}
