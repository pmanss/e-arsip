@extends('layouts.app')
@section('title','Data Arsip')
@section('title-page','Data Arsip')
@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        @if (session()->has('pesan'))
        <div class="alert alert-success alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>{{ session()->get('pesan') }}</p>
        </div>
        @endif
        @if (Auth::user()->hak_akses !== 'user')
        <a href="{{route('arsips.create')}}" class="d-inline-block mb-4">
            <button class="btn btn-success"><i class="fas fa-plus"></i> Tambah Arsip</button>
        </a>
        @endif
        <div class="table-responsive">
            <table class="table table-nowrap" id="dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nomor Dokumen</th>
                        <th>Nama Arsip</th>
                        <th>Perihal</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Tanggal Upload</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($arsips as $arsip)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $arsip->no_dokumen }}</td>
                            <td>{{ $arsip->nama_arsip }}</td>
                            <td>{{ $arsip->perihal }}</td>
                            <td>{{ $arsip->bulan }}</td>
                            <td>{{ $arsip->tahun }}</td>
                            <td>{{ date_format($arsip->created_at,'d-m-Y H:i:s') }}</td>
                            <td>
                                <i class="fas fa-lg fa-info-circle text-info modal-info-arsip mr-1 tombol-tindakan" title="Informasi" data-toggle="modal" data-target="#modal-info" data-id="{{$arsip->id}}" style="cursor:pointer;"></i>
                                <a href="{{route('arsips.show-pdf',['arsip'=>$arsip->id,'berkas'=> $arsip->nama_berkas])}}" target="_blank" class="mr-1 tombol-tindakan"> <i class="fas fa-lg fa-eye text-primary" title="Lihat Arsip"></i> </a>
                                <a href="{{route('arsips.download',['arsip'=>$arsip->id])}}" class="mr-1 tombol-tindakan"> <i class="fas fa-lg fa-download text-success" title="Download"></i> </a>
                                @if (Auth::user()->hak_akses !== 'user')
                                <a href="{{route('arsips.edit',['arsip'=>$arsip->id])}}" class="tombol-tindakan"> <i class="fas fa-lg fa-edit text-warning" title="Ubah"></i> </a>
                                <form action="{{route('arsips.destroy',['arsip' => $arsip->id ])}}" method="post" class="d-inline" id="{{'form-delete-arsip-'.$arsip->id}}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn tombol-delete-arsip tombol-tindakan" data-id="{{$arsip->id}}" data-arsip="{{$arsip->no_dokumen}}">
                                        <i class="fas fa-lg fa-trash text-danger" ></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-info">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Arsip</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <strong><i class="fas fa-book mr-1"></i> Nomor Dokumen</strong>
            <p class="text-muted" id="detail-no-dokumen"></p>
            <hr>
            <strong><i class="fas fa-bookmark mr-1"></i> Nama Arsip</strong>
            <p class="text-muted" id="detail-nama-arsip"></p>
            <hr>
            <strong><i class="fas fa-bookmark mr-1"></i> Perihal</strong>
            <p class="text-muted" id="detail-perihal"></p>
            <hr>
            <strong><i class="fa fa-calendar mr-1"></i>Bulan</strong>
            <p class="text-muted" id="detail-bulan"></p>
            <hr>
            <strong><i class="fa fa-calendar mr-1"></i>Tahun</strong>
            <p class="text-muted" id="detail-tahun"></p>
            <hr>
            <strong><i class="fa fa-calendar mr-1"></i> Tanggal Upload</strong>
            <p class="text-muted" id="detail-tanggal-upload"></p>
            <hr>
            <strong><i class="fas fa-file-pdf mr-1"></i> Nama Berkas</strong>
            <p class="text-muted" id="detail-nama-berkas"></p>
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
