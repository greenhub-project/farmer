<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function login(Request $request)
    {
        return $request->user();
    }

    public function token()
    {
        $user = auth()->user();

        $user->api_token = str_random(60);

        $user->save();

        return json_encode($user->api_token);
    }
}
