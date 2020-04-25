<?php

namespace App\Http\Controllers;

use App\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{

    public function edit(Instansi $instansi)
    {
        $this->authorize('update',Instansi::class);
        $instansi = Instansi::all()->first();
        return view('instansi.edit',['instansi'=>$instansi]);
    }

    public function update(Request $request)
    {
        $this->authorize('update',Instansi::class);
        $validateData = $request->validate([
            'nama_instansi' => 'required',
        ]);

        Instansi::where('id',1)->update([
            'nama_instansi' => $validateData['nama_instansi'],
        ]);

        return back()->with('pesan','Nama Instansi sukses diupdate');

    }

}
