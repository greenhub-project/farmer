<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farmer\Models\Protocol\Device;

class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $devices = null;

        $params = $request->validate([
            'q' => 'nullable',
        ]);

        $noParams = ! $request->has('q') or is_null($params['q']);

        if ($noParams) {
            $devices = Device::simplePaginate();
        } else {
            $params['q'] = '%'.$params['q'].'%';
            $devices = Device::where('model', 'like', $params['q'])
                ->orWhere('brand', 'like', $params['q'])
                ->orWhere('os_version', 'like', $params['q'])
                ->simplePaginate();
        }

        return view('devices.index', compact('devices'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Farmer\Models\Protocol\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Farmer\Models\Protocol\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Farmer\Models\Protocol\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        //
    }
}
