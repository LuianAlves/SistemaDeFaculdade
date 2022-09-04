<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

use Auth;
use Hash;

use Carbon\Carbon;

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

    public function profile() {
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        
        return view('profile.show', compact('user'));
    }

    public function updateProfile(Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'profile_photo_path' => 'image'
        ], [
            'name.required' => 'O campo de NOME não pode ser vazio.',
            'email.required' => 'O campo de E-MAIL não pode ser vazio.',
            'profile_photo_path.image' => 'É aceito somente arquivos PNG, JPEG, JPG.'
        ]);

        $old_img = $request->old_image;
        
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        
        if($request->file('profile_photo_path')) {
            if($old_img != '') {
                unlink(public_path('sistema/usuarios/foto/'.$old_img));
            }

            $file = $request->file('profile_photo_path');

            $filename = date('YmdHi').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('sistema/usuarios/foto/'), $filename);
            $data['profile_photo_path'] = $filename;
        } 
        
        $data->save();

        $noti = [
            'message' => 'Informações atualizadas com Sucesso!',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($noti);
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ], [
            'current_password.required' => 'O campo de SENHA ATUAL não pode ser vazio.',
            'password.required' => 'O campo de NOVA SENHA não pode ser vazio.'
        ]);

        $senha_cript = User::findOrFail($request->user_id)->password;

        if(Hash::check($request->current_password, $senha_cript)) {

            User::findOrFail($request->user_id)->update([
                'password' => Hash::make($request->password),
                'updated_at' => Carbon::now()
            ]);

            $noti = [
                'message' => 'Senha atualizada com sucesso!',
                'alert-type' => 'success'
            ];

            return redirect()->route('auth.logout')->with($noti);
        }

    }
}
