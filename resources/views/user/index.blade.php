@extends('layouts.app')
@section('title','Data User')
@section('title-page','Data User')
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        @if (session()->has('pesan'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>{{ session()->get('pesan') }}</p>
        </div>
        @endif

        <a href="{{route('users.create')}}" class="d-inline-block mb-4">
          <button class="btn btn-success"><i class="fa fa-user-plus"></i> Tambah User</button>
        </a>
        <div class="table-responsive">
        <table class="table table-nowrap" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Username</th>
              <th>Nama</th>
              <th>Hak Akses</th>
              <th>Tindakan</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->nama }}</td>
                    @if ($user->hak_akses == 'root')
                    <td> <span class="badge badge-success p-2"> <i class="fas fa-user-lock"></i> {{ $user->hak_akses }}</span> </td>
                    @elseif($user->hak_akses == 'admin')
                    <td> <span class="badge badge-warning p-2"><i class="fas fa-desktop"></i> {{ $user->hak_akses }}</span> </td>
                    @elseif($user->hak_akses == 'user')
                    <td> <span class="badge badge-info p-2"><i class="fas fa-user"></i> {{ $user->hak_akses }}</span> </td>
                    @endif
                    <td>
                        <a class="btn btn-primary btn-sm d-sm-block d-md-inline-block mb-1 modal-detail-user" href="#" data-toggle="modal" data-target="#modal-detail-user" data-id="{{$user->id}}" style="cursor:pointer;">
                                <i class="fas fa-folder">
                            </i>
                            Detail
                        </a>
                        <a class="btn btn-info btn-sm d-sm-block d-md-inline-block mb-1" href="{{route('users.edit',['user' => $user->id])}}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Ubah
                        </a>
                        @if ($user->hak_akses !== 'root')
                        <form class="d-inline" action="{{route('users.destroy',['user'=>$user->id])}}" method="post" id="{{'form-delete-user-'.$user->id}}" >
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm d-sm-block d-md-inline-block tombol-delete-user mb-1" type="submit" data-id="{{$user->id}}" data-nama="{{$user->nama}}">
                                <i class="fas fa-trash">
                                </i>
                                Hapus
                            </button>
                        </form>
                        <a class="btn btn-warning btn-sm d-sm-block d-md-inline-block mb-1" href="{{route('users.reset-password',['user' => $user->id])}}">
                            <i class="fas fa-key">
                            </i>
                            Reset Password
                        </a>
                        @endif

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data ...</td>
                </tr>
            @endforelse
          </tbody>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Username</th>
              <th>Nama</th>
              <th>Hak Akses</th>
              <th>Tindakan</th>
            </tr>
          </tfoot>

        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-detail-user">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <strong><i class="fas fa-user mr-1"></i> Username</strong>
            <p class="text-muted" id="detail-username"></p>
            <hr>
            <strong><i class="fas fa-bookmark mr-1"></i> Nama</strong>
            <p class="text-muted" id="detail-nama"></p>
            <hr>
            <strong><i class="fa fa-envelope mr-1"></i>Email</strong>
            <p class="text-muted" id="detail-email"></p>
            <hr>
            <strong><i class="fa fa-universal-access mr-1"></i>Hak Akses</strong>
            <p class="text-muted" id="detail-hak-akses"></p>
            <hr>
            <strong><i class="fa fa-calendar mr-1"></i> Mulai Aktif</strong>
            <p class="text-muted" id="detail-created-at"></p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endsection
