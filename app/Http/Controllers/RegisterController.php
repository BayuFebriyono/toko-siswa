<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('registrasi.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users|email',
            'username' => 'required|unique:users|min:8|alpha_dash',
            'name' => 'required|min:8',
            'nik' => 'required|min:16|unique:users|max:16',
            'password' => 'required|min:6'

        ]);

        $validated['password'] = bcrypt($request->password);
        User::create($validated);
        return redirect('/login')->with('success', 'Akun Ditambahkan Silahkan Login');
    }
}
