<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TokenController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Generate a new api key for the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $user = DB::transaction(function () {
            $user = auth()->user();
            $user->api_token = str_random(30);
            $user->save();

            return $user;
        });

        return response()->json([
            'token' => $user->api_token,
            'updated_at' => $user->updated_at->format('Y-m-d H:i:s')
        ]);
    }
}
