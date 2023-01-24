<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('admin-lte') }}/plugins/sweetalert2/sweetalert2.all.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('admin-lte') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <style>
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        textarea:-webkit-autofill,
        textarea:-webkit-autofill:hover,
        textarea:-webkit-autofill:focus,
        select:-webkit-autofill,
        select:-webkit-autofill:hover,
        select:-webkit-autofill:focus,
        input{
            -webkit-text-fill-color:white;
            -webkit-box-shadow: 0 0 0 30px #343a40 inset !important;
        }
        a{
            text-decoration: none;
            color: white;
        }
        a:hover{
            color: white
        }
    </style>
</head>
<body style="background-color: #515151">
    <div style="margin-bottom:75px">
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
              <a class="navbar-brand" href="/">Lelang</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Lelang</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        @if (Auth::user() != null)
                            <a href="#" class="nav-link" style="position: relative">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="{{ Auth::user()->image == null ? asset('image/defultProfile.jpeg') : asset("profile/Auth::user()->level").'/'.Auth::user()->image }}" alt="" class="rounded-circle mr-2" style="width:50px;height: 50px">
                                    </div>
                                    <div class="col-10 mt-2">
                                        <p>{{ Auth::user()->name }}
                                            @if (Auth::user()->level != "masyarakat")
                                                <small style="position: absolute;top:10px;margin-left:5px">ADMIN</small>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @else
                            <a class="nav-link" href="/login">
                                <i class="fas fa-user"></i>
                                Log in
                            </a>
                        @endif
                    </li>
                    @if (Auth::user() != null)
                        @if (Auth::user()->level == 'masyarakat')
                            <li class="nav-item">
                                <a class="nav-link {{ $sidebar == 'current_bid' ? 'active' : '' }}" href="/current_bid">
                                    <i class="fas fa-dollar-sign"></i>
                                    Your Current Binding
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link " href="/admin">
                                    <i class="fas fa-cog"></i>
                                    Admin Page
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endif
                    <hr>
                    <li class="nav-item">
                        <a class="nav-link {{ $sidebar == 'home' ? 'active' : '' }}" aria-current="page" href="/">
                            <i class="fas fa-home"></i>
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ $sidebar == 'history' ? 'active' : '' }}" aria-current="page" href="/history">
                            <i class="fas fa-history"></i>
                            History Lelang
                        </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
        </nav>
    </div>
    @yield('content')

    <script src="{{ asset('bootstrap') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('bootstrap') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin-lte') }}/plugins/sweetalert2/sweetalert2.all.min.js"></script>

<script>
    @if($message = Session::get('success'))
      Swal.fire({
        icon: 'success',
        title: 'App Said : ',
        text: '{{$message}}',
      })
    @endif
    @if($message = Session::get('warning'))
      Swal.fire({
        icon: 'warning',
        title: 'App Said : ',
        text: '{{$message}}',
      })
    @endif
    @if($message = Session::get('error'))
      Swal.fire({
        icon: 'error',
        title: 'App Said : ',
        text: '{{$message}}',
      })
    @endif
</script>
</body>
</html>
