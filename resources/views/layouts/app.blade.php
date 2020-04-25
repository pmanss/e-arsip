<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="">
  <meta name="author" content="">


  <title>@yield('title') | {{ config('app.name') }}</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('/css/sb-admin-2.min.css')}}" rel="stylesheet">
  {{-- select2 --}}
  <link href="{{asset('/css/select2.min.css')}}" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="{{asset('/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

  <link href="{{asset('/css/style.css')}}" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
        <div class="sidebar-brand-icon">
          <i class="fas fa-archive"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }} 1.0</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('arsips.index')}}">
          <i class="fas fa-folder-open"></i>
          <span>Arsips</span></a>
      </li>
      @if (Auth::user()->hak_akses !== 'user')
        <li class="nav-item">
          <a class="nav-link" href="{{route('arsips.trash')}}">
            <i class="fas fa-trash"></i>
            <span>Sampah Arsip</span></a>
        </li>
        @endif

        @if (Auth::user()->hak_akses === 'root')
            <li class="nav-item">
              <a class="nav-link" href="{{route('users.index')}}">
                <i class="fas fa-users"></i>
                <span>Users</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('instansi.edit')}}">
                <i class="fas fa-building"></i>
                <span>Instansi</span></a>
            </li>

        @endif





      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars text-success"></i>
            </button>
            <div class="d-none d-md-block">
                <h5 class="mx-3"><b>{{ App\Instansi::all()->first()->nama_instansi }}</b></h5>
            </div>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-inline text-gray-600"> <b>{{ Auth::user()->nama }}</b> </span>
                <i class="fa fa-user-circle fa-2x"></i>
            </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="{{route('edit-password')}}">
                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                    Ubah kata sandi
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('logout')}}">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Keluar
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@yield('title-page')</h1>
          </div>

          @yield('content')
        </div>

        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; {{ config('app.name') }} <sup>1.0</sup> {{ date('Y') }}</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('/js/sb-admin-2.min.js')}}"></script>


  <!-- Page level plugins -->
  <script src="{{asset('/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('/js/demo/datatables-demo.js')}}"></script>

  {{-- sweetAlert --}}
  <script src="{{asset('/js/sweetalert2.all.min.js')}}"></script>

  {{-- select2 --}}
  <script src="{{asset('/js/select2.min.js')}}"></script>



  <script src="{{asset('/js/script.js')}}"></script>


</body>

</html>
