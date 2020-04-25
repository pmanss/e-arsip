<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
Use App\Instansi;

class AuthController extends Controller
{
    public function getLogin()
    {
        $instansi = Instansi::all()->first();
        return view('auth.login',['instansi'=> $instansi]);
    }

    public function postLogin(Request $request)
    {
        $validateData = $request->validate([
            'username' => 'required|alpha_dash',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $validateData['username'],'password' => $validateData['password']]))
        {
            return redirect()->route('dashboard');
        }else {
            return back()->with('pesan','username / password tidak sesuai');
        }



    }

    public function editPassword()
    {
        return view('auth.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $validateData = $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ]);


        if (Hash::check($validateData['password_lama'],Auth::user()->password)) {
            User::where('id',Auth::user()->id)->first()->update([
                'password' => bcrypt($validateData['password_baru']),
            ]);

            return redirect()->back()->with('pesan-sukses',"Kata sandi sukses diupdate");
        }else {
            return redirect()->back()->with('pesan-error','Kata sandi lama tidak cocok');
        }
    }



    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
