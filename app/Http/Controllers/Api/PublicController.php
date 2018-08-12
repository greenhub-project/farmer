<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class PublicController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['api', 'cors']);
    }

    public function count($model)
    {
        try {
            return \DB::table($model)->count();
        } catch (\Exception $e) {
            return -1;
        }
    }

    public function status()
    {
        return ['status' => 'online'];
    }
}
