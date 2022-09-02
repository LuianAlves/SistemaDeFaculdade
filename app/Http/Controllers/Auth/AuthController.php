<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class AuthController extends Controller
{
    public function logout(Request $request) {

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $noti = [
            'message' => 'Usuário deslogado com sucesso!',
            'alert-type' => 'error'
        ];

        return redirect()->route('login')->with($noti);
    }
}
