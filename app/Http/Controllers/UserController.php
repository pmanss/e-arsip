<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny',User::class);
        $users = User::all();
        return view ('user.index',['users'=> $users]);
    }

    public function create()
    {
        $this->authorize('create',User::class);
        return view('user.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create',User::class);
        $validateData = $request->validate([
            'username' => 'required|min:3|alpha_dash|unique:users',
            'nama' => 'required|min:3',
            'hak_akses' => 'required|in:admin,user',
            'email' => 'nullable|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'username' => $validateData['username'],
            'nama' => $validateData['nama'],
            'hak_akses' => $validateData['hak_akses'],
            'email' => $validateData['email'],
            'password' => bcrypt($validateData['password']),
        ]);

        return redirect()->back()->with('pesan',"{$validateData['hak_akses']} dengan nama {$validateData['nama']} sukses ditambahkan");
    }

    public function show($id)
    {
       $this->authorize('view',User::class);
       $user = User::where('id',$id)->first();

        return response()->json($user);
    }

    public function edit($id)
    {
        $this->authorize('update',User::class);
        $user = User::where('id',$id)->first();
        return view('user.edit',['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update',User::class);
        $validateData = $request->validate([
            'username' => 'required|min:3|alpha_dash|unique:users,username,'.$id,
            'nama' => 'required|min:3',
            'hak_akses' => 'required|in:root,admin,user',
            'email' => 'nullable|email|unique:users,email,'.$id,
        ]);

        User::where('id',$id)->update($validateData);

        return back()->with('pesan','Data Sukses diupdate');
    }

    public function resetPassword($id)
    {
        $this->authorize('resetPassword',User::class);
        $user = User::where('id',$id)->first();
        return view('user.reset-password',['user'=> $user]);
    }

    public function postResetPassword(Request $request,$id)
    {
        $this->authorize('resetPassword',User::class);
        $validateData = $request->validate([
            'kata_sandi_baru' => 'required|min:6|confirmed',

        ]);

        User::where('id',$id)->update([
            'password' => bcrypt($validateData['kata_sandi_baru']),
        ]);

        return back()->with('pesan',"Kata sandi sukses direset");

    }

    public function destroy($id)
    {
        $this->authorize('delete',User::class);
        $user = User::where('id',$id)->first();
        User::where('id',$id)->delete();


        return back()->with('pesan',"{$user->nama} sukses dihapus");
    }

}
