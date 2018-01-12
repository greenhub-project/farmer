<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function redirect()
    {
        return redirect('settings/account');
    }

    public function account()
    {
        $user = auth()->user();

        return view('settings.account', compact('user'));
    }

    public function password()
    {
        $user = auth()->user();

        return view('settings.password', compact('user'));
    }

    public function api()
    {
        $user = auth()->user();

        return view('settings.api', compact('user'));
    }
}
