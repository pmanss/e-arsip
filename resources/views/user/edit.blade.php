@extends('layouts.app')
@section('title','Edit User')
@section('title-page','Edit User')
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
                    <form action="{{route('users.update',['user'=>$user->id])}}" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') ?? $user->username }}" autocomplete="off">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{old('nama') ?? $user->nama}}" autocomplete="off">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                             @enderror

                        </div>
                        @if ($user->hak_akses !== 'root')
                            <div class="form-group">
                                <label for="hak_akses">Hak Akses</label>
                                <select name="hak_akses" id="hak_akses" class="form-control custom-select">
                                    <option value="admin" {{ (old('hak_akses') ?? $user->hak_akses) == 'admin' ? 'selected' : ''}}>Admin</option>
                                    <option value="user" {{ (old('hak_akses') ?? $user->hak_akses) == 'user' ? 'selected' : ''}}>User</option>
                                </select>
                            </div>
                        @else
                        <div class="form-group">
                            <label for="hak_akses">Hak Akses</label>
                            <select name="hak_akses" id="hak_akses" class="form-control custom-select">
                                <option value="root" selected>root</option>
                            </select>
                        </div>

                        @endif
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email') ?? $user->email}}" autocomplete="off">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>


                        <button class="btn btn-success" type="submit"></i> Simpan</button>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
