@extends('layouts.app')
@section('title','Profil Instansi')
@section('title-page','Profil Instansi')
@section('content')
    <div class="card">
        <div class="card-body">
            @if (session()->has('pesan'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>{{ session()->get('pesan') }}</p>
            </div>
            @endif

            <div class="row">
                <div class="col">
                    <form action="{{route('instansi.update')}}" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="nama_instansi">Nama Instansi</label>
                            <input type="text" class="form-control @error('nama_instansi') is-invalid @enderror" name="nama_instansi" value="{{old('nama_instansi') ?? $instansi->nama_instansi}}" autocomplete="off">
                            @error('nama_instansi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                             @enderror

                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
