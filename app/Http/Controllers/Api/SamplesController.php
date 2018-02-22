<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Farmer\Models\Protocol\Sample;
use App\Http\Resources\SampleResource;

class SamplesController extends Controller
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
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return SampleResource::collection(Sample::simplePaginate());
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
        return SampleResource::make($sample);
    }
}
