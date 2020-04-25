<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Arsip;

class ArsipController extends Controller
{

    public function index()
    {
        $arsips = Arsip::latest()->get();
        return view('arsip.index',compact('arsips'));
    }

    public function create()
    {
        $this->authorize('create',Arsip::class);
        return view('arsip.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create',Arsip::class);
        $validateData = $request->validate([
            'no_dokumen' => 'required|unique:arsips',
            'nama_arsip' => 'required|min:3',
            'perihal' => '',
            'bulan' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'tahun' => 'required',
            'berkas' => 'required|file|mimes:pdf',
        ]);

        DB::beginTransaction();
        try {
            $path = $request->berkas->store("public/berkas/{$validateData['tahun']}/{$validateData['bulan']}");
            $namaBerkas = substr($path,-44);

            Arsip::create([
                'no_dokumen' => $validateData['no_dokumen'],
                'nama_arsip' => $validateData['nama_arsip'],
                'perihal' => $validateData['perihal'],
                'bulan' => $validateData['bulan'],
                'tahun' => $validateData['tahun'],
                'nama_berkas' => $namaBerkas,
            ]);

            DB::commit();
            return back()->with('pesan',"Arsip dengan nomor dokumen {$validateData['no_dokumen']} berhasil disimpan");

        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function show($id)
    {
        $arsip = Arsip::where('id',$id)->first();
        return response()->json($arsip);
    }

    public function showArsipPDF($id)
    {
        $arsip = Arsip::where('id',$id)->first();
        if (!$arsip) {
            $arsip = Arsip::onlyTrashed()->where('id',$id)->first();
            $berkas = $arsip->nama_berkas;
            $path = 'app/public/berkas/sampah/'.$berkas;
            return response()->file(storage_path($path, 'inline'));

        }else {
            $berkas = $arsip->nama_berkas;
            $path = 'app/public/berkas/'.$arsip->tahun.'/'.$arsip->bulan.'/'.$berkas;
            return response()->file(storage_path($path, 'inline'));
        }
    }

    public function download($id)
    {
        $arsip = Arsip::findOrFail($id);
        $berkas = $arsip->nama_berkas;
        $path = 'app/public/berkas/'.$arsip->tahun.'/'.$arsip->bulan.'/'.$berkas;
        return response()->download(storage_path($path));
    }

    public function edit($id)
    {
        $this->authorize('update',Arsip::class);
        $arsip = Arsip::findOrFail($id);
        return view('arsip.edit',['arsip'=>$arsip]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update',Arsip::class);
        $validateData = $request->validate([
            'no_dokumen' => 'required|unique:arsips,no_dokumen,'.$id,
            'nama_arsip' => 'required|min:3',
            'perihal' => '',
            'bulan' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'tahun' => 'required',
        ]);

        $arsip = Arsip::where('id',$id)->first();

        DB::beginTransaction();
        try {
            Arsip::where('id',$id)->update($validateData);
            $berkas = "public/berkas/{$arsip['tahun']}/{$arsip['bulan']}/{$arsip['nama_berkas']}";
            $destination = "public/berkas/{$validateData['tahun']}/{$validateData['bulan']}/{$arsip['nama_berkas']}";
            if ($berkas !== $destination) {
                Storage::move($berkas, $destination);
            }
            DB::commit();

            return back()->with('pesan',"Arsip dengan nomor dokumen {$validateData['no_dokumen']} berhasil diupdate");

        } catch (Exception $e) {
            DB::rollback();;
        }

    }


    public function destroy($id)
    {
        $this->authorize('delete',Arsip::class);
        DB::beginTransaction();
        $arsip = Arsip::where('id',$id)->first();
        $berkas = "public/berkas/{$arsip['tahun']}/{$arsip['bulan']}/{$arsip['nama_berkas']}";
        $destination = "public/berkas/sampah/{$arsip['nama_berkas']}/";

        if (Storage::exists($berkas)) {
            Storage::move($berkas, $destination);
            Arsip::where('id',$id)->first()->delete();
            DB::commit();
            return back()->with('pesan',"Arsip dengan nomor {$arsip['no_dokumen']} berhasil dihapus");
        }else {
            DB::rollback();
        }

    }

    public function trash()
    {
        $this->authorize('trash',Arsip::class);
        $arsips = Arsip::onlyTrashed()->get();
        return view('arsip.trash',['arsips'=>$arsips]);

    }

    public function restore($id)
    {
        $this->authorize('restore',Arsip::class);
        $arsip = Arsip::onlyTrashed()->where('id',$id)->first();
        $berkas = "public/berkas/sampah/{$arsip['nama_berkas']}";
        $destination = "public/berkas/{$arsip['tahun']}/{$arsip['bulan']}/{$arsip['nama_berkas']}";
        DB::beginTransaction();
        if (Storage::exists($berkas)) {
            Arsip::onlyTrashed()->where('id',$id)->restore();
            Storage::move($berkas, $destination);
            DB::commit();
            return back()->with('pesan',"Arsip dengan nomor {$arsip['no_dokumen']} berhasil direstore");
        }else {
            DB::rollback();
        }
    }

    public function forceDelete($id)
    {
        $this->authorize('forceDelete',Arsip::class);
        $arsip = Arsip::onlyTrashed()->where('id',$id)->first();
        $berkas = "public/berkas/sampah/{$arsip['nama_berkas']}";
        DB::beginTransaction();
        if (Storage::exists($berkas)) {
            Storage::delete($berkas);
            Arsip::onlyTrashed()->where('id',$id)->forceDelete();
            DB::commit();
            return back()->with('pesan',"Arsip dengan nomor {$arsip['no_dokumen']} berhasil dihapus permanen");
        }else {
            DB::rollback();
        }

    }

    public function emptyTrash()
    {
        $this->authorize('emptyTrash',Arsip::class);
        $arsips = Arsip::onlyTrashed()->get()->toArray();
        foreach ($arsips as $arsip) {
        Arsip::onlyTrashed()->where('id',$arsip['id'])->forceDelete();
        Storage::delete("public/berkas/sampah/{$arsip['nama_berkas']}");
        }
        return back()->with('pesan',"Sampah arsip berhasil dikosongkan");
    }

}
