<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function count($model, Request $request)
    {
        $today = Carbon::today();

        $data = $request->validate([
            'interval' => 'required'
        ]);

        switch ($data['interval']) {
            case 'today':
                return \DB::table($model)->where('created_at', '>=', $today)->count();
            case 'week':
                return \DB::table($model)->where('created_at', '>=', $today->startOfWeek())->count();
            case 'month':
                return \DB::table($model)->where('created_at', '>=', $today->startOfMonth())->count();
        }
    }
}
