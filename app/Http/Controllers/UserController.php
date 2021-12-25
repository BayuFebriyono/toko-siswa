<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (auth()->user()->username !== $user->username) {
            abort(403);
        }
        return view('user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $rules = [
            'email' => 'required|email:dns',
            'username' => 'required|min:8|alpha_dash',
            'name' => 'required|min:8',
        ];
        if ($request->password) {
            $rules['password'] = 'required|min:6';
        }
        if ($request->email != $user->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }
        if ($request->username != $user->username) {
            $rules['username'] = 'required|unique:users|min:8|alpha_dash';
        }
        $validatedData = $request->validate($rules);
        if ($request->password) $validatedData['password'] = bcrypt($request->password);
        User::where('id', $user->id)->update($validatedData);
        return redirect('/myaccount')->with('success', 'Profil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
