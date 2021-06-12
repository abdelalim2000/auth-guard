<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', Password::default()]
        ]);

        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (!auth('admin')->attempt($credentials, $request->filled('remember'))) {
            session()->flash('login-error', 'Credentials are not available');
        }

        $admin = Admin::query()->where('email', $request->email)->firstOrFail();

        Auth::guard('admin')->login($admin);

        return redirect(RouteServiceProvider::HOME);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => ['required', Password::default()]
        ]);

        $admin = Admin::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::guard('admin')->login($admin);

        return redirect(RouteServiceProvider::HOME);
    }
}
