<?php

namespace App\Http\Controllers\Dashboard;

use App\Farmer\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class MembersController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $users = User::simplePaginate();

        return view('dashboard.members', compact('users', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User                     $member
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $member)
    {
        $validatedData = $request->validate([
            'role' => 'required',
        ]);

        $member->toggleRole($validatedData['role']);

        return json_encode([
            'changed' => $member->hasRole($validatedData['role']),
        ]);
    }
}
