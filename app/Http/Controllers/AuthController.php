<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logout()
    {
        Auth::logout();
        session()->flash('notify', [
            'type' => 'success',
            'content' => __('Logged out successfully'),
            'duration' => 4000
        ]);
        return redirect()->route('dashboard');
    }
}
