<?php

namespace App\Http\Controllers\Api;

use App\Farmer\Models\Protocol\Settings;
use App\Http\Controllers\Controller;
use App\Http\Resources\SettingsResource;

class SettingsController extends Controller
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
     * @return SettingsResource
     */
    public function index(Request $request)
    {
        if ($request->has('per_page')) {
            $this->perPage = $request->per_page;
        }

        return SettingsResource::collection(Settings::simplePaginate($this->perPage));
    }

    /**
     * Display the specified resource.
     *
     * @param Settings $settings
     * @return SettingsResource
     */
    public function show(Settings $settings)
    {
        return new SettingsResource($settings);
    }
}
