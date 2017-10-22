<?php

namespace App\Http\Controllers;

use App\Farmer\Models\Protocol\Sample;
use Illuminate\Http\Request;

class SamplesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $samples = null;

        $params = $request->validate([
            'q' => 'nullable'
        ]);

        $noParams = ! $request->has('q') or is_null($params['q']);

        if ($noParams) {
            $samples = Sample::simplePaginate();
        } else {
            $params['q'] = '%' . $params['q'] . '%';
            $samples = Sample::where('battery_state', 'like', $params['q'])
                ->orWhere('battery_level', 'like', $params['q'])
                ->orWhere('network_status', 'like', $params['q'])
                ->orWhere('timezone', 'like', $params['q'])
                ->simplePaginate();
        }

        return view('samples.index', compact('samples'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
