<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpdateController extends Controller
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

    public function account(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email'=> 'required|email',
        ]);

        auth()->user()->update($data);

        flash()->success('Profile updated!', 'The changes were saved successfully');

        return back();
    }

    public function password(Request $request)
    {
        $data = $request->validate([
            'new_password' => 'required|min:6',
            'repeat_password'=> 'required|min:6|same:new_password',
        ]);

        auth()->user()->update([
            'password' => bcrypt($data['new_password']),
        ]);

        flash()->success('Password changed!', 'The changes were saved successfully');

        return back();
    }

    public function api()
    {
        $user = auth()->user();

        $user->update([
            'api_token' => str_random(60),
        ]);

        return json_encode($user->api_token);
    }
}
