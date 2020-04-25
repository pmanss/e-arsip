@extends('layouts.app')
@section('title','Tambah User')
@section('title-page','Tambah User')
@section('content')
    @if (session()->has('pesan'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p>{{ session()->get('pesan') }}</p>
    </div>
    @endif
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('users.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username *</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username')}}" autocomplete="off">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama *</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{old('nama')}}" autocomplete="off">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                             @enderror

                        </div>
                        <div class="form-group">
                            <label for="hak_akses">Hak Akses *</label>
                            <select name="hak_akses" id="hak_akses" class="form-control custom-select">
                                <option value="admin" {{ old('hak_akses') == 'admin' ? 'selected' : ''}}>Admin</option>
                                <option value="user" {{ old('hak_akses') == 'user' ? 'selected' : ''}}>User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" autocomplete="off">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="password">Kata Sandi *</label>
                            <div class="input-group">
                                <input type="password" class="form-control input-password @error('password') is-invalid @enderror" id="password" name="password" value="{{old('password')}}" autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary button-password" type="button">
                                        <i class="fas fa-eye" id="icon-password"></i>
                                    </button>
                                </div>

                            </div>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Konfirmasi kata Sandi *</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password" name="password_confirmation" autocomplete="off">
                        </div>

                        <label class="d-block text-dark">* Wajib diisi</label>


                        <button class="btn btn-success" type="submit">Kirim</button>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
