<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SampleResource;
use App\Farmer\Models\Protocol\Settings;

class SettingsSampleController extends Controller
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
     * @param Settings $settings
     * @return SampleResource
     */
    public function index(Settings $settings)
    {
        return new SampleResource($settings->sample);
    }
}
