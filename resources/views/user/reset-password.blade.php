@extends('layouts.app')
@section('title','Reset Kata Sandi')
@section('title-page','Reset Kata Sandi')
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
                    <form action="{{route('users.post-reset-password',['user'=>$user->id])}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="new-password">Kata Sandi Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control input-password @error('kata_sandi_baru') is-invalid @enderror" name="kata_sandi_baru" id="new-password" value="{{old('kata_sandi_baru')}}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary button-password" type="button">
                                        <i class="fas fa-eye" id="icon-password"></i>
                                    </button>
                                </div>
                                @error('kata_sandi_baru')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new-password-confirm">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" class="form-control" name="kata_sandi_baru_confirmation" id="new-password-confirm">
                        </div>
                        @error('kata_sandi_baru')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <button class="btn btn-success" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
