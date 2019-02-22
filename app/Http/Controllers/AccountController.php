<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateAccountRequest;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show my account page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('pages.account', compact('user'));
    }

    /**
     * Generate a new api key for the authenticated user.
     *
     * @param \App\Http\Requests\UpdateAccountRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request)
    {
        $attributes = $request->validated();

        DB::transaction(function () use ($attributes) {
            $user = auth()->user();
            $user->update($attributes);
        });

        return redirect(route('home'))->with('status', 'Your profile has been updated successfully.');
    }
}
