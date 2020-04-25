@extends('layouts.app')
@section('title','Ubah Data Arsip')
@section('title-page','Ubah Data Arsip')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    @if (session()->has('pesan'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p>{{ session()->get('pesan') }}</p>
                    </div>
                    @endif

                    <form action="{{route('arsips.update',['arsip'=>$arsip->id])}}" method="post">
                        @method('PATCH')
                        @csrf

                        <div class="form-group">
                            <label for="no_dokumen">No Dokumen</label>
                            <input type="text" class="form-control @error('no_dokumen') is-invalid @enderror" name="no_dokumen" id="no_dokumen" value="{{old('no_dokumen') ?? $arsip->no_dokumen}}" autocomplete="off">
                            @error('no_dokumen')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="nama_arsip">Nama Arsip</label>
                            <input type="text" class="form-control @error('nama_arsip') is-invalid @enderror" name="nama_arsip" id="nama_arsip" value="{{old('nama_arsip') ?? $arsip->nama_arsip}}" autocomplete="off">
                            @error('nama_arsip')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="perihal">Perihal</label>
                            <input type="text" class="form-control @error('perihal') is-invalid @enderror" name="perihal" id="perihal" value="{{old('perihal') ?? $arsip->perihal}}" autocomplete="off">
                            @error('perihal')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group w-50">
                            <label for="bulan">Bulan</label>
                            <select name="bulan" id="bulan" class="select-bulan">
                                <option value="Januari" {{(old('bulan') ?? $arsip->bulan) == 'Januari' ? 'selected' : ''}}>Januari</option>
                                <option value="Februari" {{(old('bulan') ?? $arsip->bulan) == 'Februari' ? 'selected' : ''}}>Februari</option>
                                <option value="Maret" {{(old('bulan') ?? $arsip->bulan) == 'Maret' ? 'selected' : ''}}>Maret</option>
                                <option value="April" {{(old('bulan') ?? $arsip->bulan) == 'April' ? 'selected' : ''}}>April</option>
                                <option value="Mei" {{(old('bulan') ?? $arsip->bulan) == 'Mei' ? 'selected' : ''}}>Mei</option>
                                <option value="Juni" {{(old('bulan') ?? $arsip->bulan) == 'Juni' ? 'selected' : ''}}>Juni</option>
                                <option value="Juli" {{(old('bulan') ?? $arsip->bulan) == 'Juli' ? 'selected' : ''}}>Juli</option>
                                <option value="Agustus" {{(old('bulan') ?? $arsip->bulan) == 'Agustus' ? 'selected' : ''}}>Agustus</option>
                                <option value="September" {{(old('bulan') ?? $arsip->bulan) == 'September' ? 'selected' : ''}}>September</option>
                                <option value="Oktober" {{(old('bulan') ?? $arsip->bulan) == 'Oktober' ? 'selected' : ''}}>Oktober</option>
                                <option value="November" {{(old('bulan') ?? $arsip->bulan) == 'November' ? 'selected' : ''}}>November</option>
                                <option value="Desember" {{(old('bulan') ?? $arsip->bulan) == 'Desember' ? 'selected' : ''}}>Desember</option>
                            </select>
                        </div>

                        <div class="form-group w-50">
                            <label for="tahun">Tahun</label>
                            <select name="tahun" id="tahun" class="select-tahun">
                                @for ($i = 1970; $i <= date('Y'); $i++)
                                <option value="{{$i}}" {{(old('tahun') ?? $arsip->tahun) == $i ? 'selected' : ''}}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Simpan</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
