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

    public function profile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email'=> 'required|email',
        ]);

        $user = \Auth::user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        flash()->success('Profile updated!', 'The changes were saved successfully');

        return back();
    }

    public function password(Request $request)
    {
        $this->validate($request, [
            'new_password' => 'required|min:6',
            'confirm_password'=> 'required|min:6|same:new_password',
        ]);

        $user = \Auth::user();

        $user->update([
            'password' => bcrypt($request->new_password),
        ]);

        flash()->success('Password changed!', 'The changes were saved successfully');

        return back();
    }

    public function api()
    {
        $user = \Auth::user();

        $user->update([
            'api_token' => str_random(60),
        ]);

        flash()->success('New token generated', 'Make sure to keep it in a secure place.');

        return back();
    }
}
