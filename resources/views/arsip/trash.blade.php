@extends('layouts.app')
@section('title','Sampah Arsip')
@section('title-page','Sampah Arsip')
@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        @if (session()->has('pesan'))
        <div class="alert alert-success alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>{{ session()->get('pesan') }}</p>
        </div>
        @endif
        <a href="{{route('arsips.empty-trash')}}" class="d-inline-block mb-4 tombol-empty-trash">
            <button class="btn btn-danger"><i class="fa fa-trash"></i> Kosongkan sampah</button>
          </a>
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
                        <th>Dihapus</th>
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
                            <td>{{ date_format($arsip->deleted_at,'d-m-Y H:i:s') }}</td>
                            <td>
                                <a href="{{route('arsips.show-pdf',['arsip'=>$arsip->id,'berkas'=> $arsip->nama_berkas])}}" target="_blank" class="mr-1"> <i class="fas fa-lg fa-eye text-primary" title="Lihat Arsip"></i> </a>
                                <a href="{{route('arsips.restore',['arsip'=>$arsip->id])}}" class="mr-1"> <i class="fas fa-lg fa-trash-restore text-info" title="Restore"></i> </a>
                                <a href="{{route('arsips.force-delete',['arsip' => $arsip->id ])}}" data-id="{{$arsip->id}}" data-arsip="{{$arsip->no_dokumen}}" class="tombol-force-delete-arsip"> <i class="fas fa-lg fa-trash text-danger" title="Hapus"></i> </a>
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
            <p class="text-muted" id="detailNoDokumen"></p>
            <hr>
            <strong><i class="fas fa-bookmark mr-1"></i> Nama Arsip</strong>
            <p class="text-muted" id="detailNamaArsip"></p>
            <hr>
            <strong><i class="fas fa-user mr-1"></i> Pengupload</strong>
            <p class="text-muted" id="detailPengupload"></p>
            <hr>
            <strong>Bulan</strong>
            <p class="text-muted" id="detailBulan"></p>
            <hr>
            <strong>Tahun</strong>
            <p class="text-muted" id="detailTahun"></p>
            <hr>
            <strong><i class="fa fa-calendar mr-1"></i> Tanggal Upload</strong>
            <p class="text-muted" id="detailTanggalUpload"></p>
            <hr>
            <strong><i class="fas fa-file-pdf mr-1"></i> Nama Berkas</strong>
            <p class="text-muted" id="detailNamaBerkas"></p>
            <hr>

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
