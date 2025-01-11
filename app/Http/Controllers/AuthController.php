<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } else {
                return response()->json([
                    'message' => 'Login successful',
                    'success' => true  
                ], 200);
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->with('error', 'Invalid phone number');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('admin.login');
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
}
