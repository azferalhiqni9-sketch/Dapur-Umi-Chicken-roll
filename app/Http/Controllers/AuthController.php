<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampil form login
    public function showLogin()
    {
        return view('admin.login');
    }
    
    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        
        if (Auth::attempt($credentials)) {
            // Cek apakah user adalah admin
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');
            }
            
            Auth::logout();
            return back()->with('error', 'Akun tidak memiliki akses admin!');
        }
        
        return back()->with('error', 'Email atau password salah!');
    }
    
    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Berhasil logout!');
    }
}