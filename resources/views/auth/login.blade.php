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


  <title>Login | {{config('app.name')}}</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-light">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-sm-8 col-md-6">

            <div class="text-center mt-5">
                <h4> <b>{{ config('app.name') }}</b>  1.0</h4>
            </div>
          <div class="card o-hidden border-0 shadow-lg mt-2">
              <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col">
                <div class="card ">
                    {{-- <div class="card-header bg-success">
                        <div class="card-title text-light text-center">
                            <h4><i class="fas fa-building"></i> {{ $instansi->nama_instansi }}</h4>
                        </div>
                    </div> --}}
                    <div class="p-5">
                      <div class="text-center">
                        @if (session()->has('pesan'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session()->get('pesan') }}
                          </div>
                        @endif
                      </div>
                      <form class="user" action="{{route('proses-login')}}" method="post">
                            @csrf
                        <div class="form-group">
                          <input type="username" class="form-control form-control-user @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username" value="{{old('username')}}" autocomplete="off">
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control input-password form-control-user @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" autocomplete="off">
                            @error('password')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success btn-user btn-block text-light font-weight-bold">
                              Masuk
                            </button>
                        </div>
                      </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('/js/sb-admin-2.min.js')}}"></script>

  <script src="{{asset('/js/script.js')}}"></script>


</body>

</html>
