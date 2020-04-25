$(document).ready(function name(params) {
    $('.select-bulan').select2({width: '100%'})
    $('.select-tahun').select2({width: '100%'})
});

$('.tombol-delete-user').on('click', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    const FORM_HAPUS = $('#form-delete-user-'+id);
    var nama = $(this).data('nama');
    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: nama + " akan dihapus",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.value) {

           FORM_HAPUS.submit();
        }
      })

});

$('.tombol-delete-arsip').on('click', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    const FORM_HAPUS = $('#form-delete-arsip-'+id);
    var no_dokumen = $(this).data('arsip');
    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: "Arsip dengan nomor "+no_dokumen + " akan dihapus",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.value) {

            FORM_HAPUS.submit();
        }
      })

});

$('.tombol-force-delete-arsip').on('click', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var no_dokumen = $(this).data('arsip');
    var url = $(this).attr('href');
    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: "Arsip dengan nomor "+no_dokumen + " akan dihapus permanen",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.value) {
            window.location.href = url;

        }
      })

});

$('.tombol-empty-trash').on('click', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    Swal.fire({
        title: 'Apakah anda yakin ingin?',
        text: "Data sampah arsip akan dikosongkan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.value) {
            window.location.href = url;

        }
      })

});


$(".button-password").on('click',function() {
    var in_pass = $(".input-password");
    var icon = $("#icon-password");
    if (in_pass.attr('type') === 'password') {
        in_pass.attr('type', 'text');
        $(".button-password").html("<i class='fas fa-eye-slash'></i>");
    } else {
        in_pass.attr('type', 'password');
        $(".button-password").html("<i class='fas fa-eye'></i>");
    }
});


$(".modal-detail-user").on('click', function () {
    $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    const ID = $(this).data('id');


    $.ajax({
        url: "/users/"+ID,
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            $('#detail-username').text(data.username);
            $('#detail-nama').text(data.nama);
            $('#detail-email').text(data.email);
            $('#detail-hak-akses').text(data.hak_akses);
            $('#detail-created-at').text(data.created_at);

        }


    });
});


$(".modal-info-arsip").on('click', function () {
    $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    const ID = $(this).data('id');


    $.ajax({
        url: "/arsips/"+ID,
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            $('#detail-no-dokumen').text(data.no_dokumen);
            $('#detail-nama-arsip').text(data.nama_arsip);
            $('#detail-perihal').text(data.perihal);
            $('#detail-bulan').text(data.bulan);
            $('#detail-tahun').text(data.tahun);
            $('#detail-tanggal-upload').text(data.created_at);
            $('#detail-nama-berkas').text(data.nama_berkas);

        }


    });
});
