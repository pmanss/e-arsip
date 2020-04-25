<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Arsip;


class PageController extends Controller
{
    public function dashboard()
    {
        $users = User::where('hak_akses','user');
        $total_users = $users->count();
        $admins = User::where('hak_akses','admin');
        $total_admins = $admins->count();
        $total_arsips = Arsip::all()->count();
        $total_trashs = Arsip::onlyTrashed()->count();
        $arsips_terbaru = Arsip::latest()->limit(10)->get();
        return view('dashboard',[ 'total_users' => $total_users, 'total_admins' => $total_admins, 'total_arsips' => $total_arsips, 'total_trashs' => $total_trashs, 'arsips_terbaru' => $arsips_terbaru ]);
    }

}
