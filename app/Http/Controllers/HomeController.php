<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Usuarios;

use Auth;

class HomeController extends Controller
{
    public function home() {
        return view('home');
    }

    public function dashboard() {
        $userLogado = Auth::id();
        $user = User::where('id', $userLogado)->first();

        $usuario = Usuarios::where('id', $user->usuario_id)->first();

        return view('app.index', compact('usuario'));
    }
}
