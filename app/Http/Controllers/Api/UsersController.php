<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UsersController extends Controller
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
     * @param Request $request
     *
     * @return UserResource
     */
    public function index(Request $request)
    {
        return new UserResource($request->user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return UserResource
     */
    public function update(Request $request)
    {
        $request->validate([
            'cli' => 'required',
        ]);

        $user = $request->user();
        $user = tap($user)->update([
            'api_token' => str_random(60),
        ]);

        return new UserResource($user);
    }

    public function token(Request $request)
    {
        $user = $request->user();

        $user->update([
            'api_token' => str_random(60),
        ]);

        return json_encode([
            'data' => [
                'api_token' => $user->api_token,
            ],
        ]);
    }
}
