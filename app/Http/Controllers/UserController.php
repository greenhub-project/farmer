<?php

namespace App\Http\Controllers;

use App\Farmer\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $bag = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::simplePaginate($this->bag));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Farmer\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Farmer\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Farmer\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $attributes = $request->validate([
            'role' => 'required|string',
        ]);

        $newRole = $attributes['role'] === 'member' ? 'admin' : 'member';

        $user->assignRole($newRole);
        $user->removeRole($attributes['role']);

        return response()->json(compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Farmer\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return response()->json(['result' => $user->delete()]);
    }
}
