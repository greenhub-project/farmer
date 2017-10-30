<?php

namespace App\Http\Controllers\Api;

use App\Farmer\Models\Protocol\Sample;
use App\Http\Controllers\Controller;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SampleResource::collection(Sample::simplePaginate());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Farmer\Models\Protocol\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function show(Sample $sample)
    {
        return SampleResource::make($sample);
    }
}
