<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function logout()
    {
        Auth::logout(); // Proses logout pengguna
        return redirect()->route('login'); // Redirect ke halaman login setelah logout
    }
}
