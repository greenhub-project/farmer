<?php

namespace App\Http\Controllers\Api;

use App\Device;
use App\Http\Controllers\Controller;
use App\Sample;
use App\User;

class PublicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['api', 'cors']);
    }

    public function count($model)
    {
        switch ($model) {
            case 'devices':
                $total = Device::count();
                break;
            case 'samples':
                $total = Sample::count();
                break;
            case 'users':
                $total = User::count();
                break;
            default:
                $total = -1;
        }

        return json_encode($total);
    }
}
