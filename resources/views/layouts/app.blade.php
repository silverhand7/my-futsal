<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body style="background-color:#F1F5F9">
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" width="250">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page"  href="{{ url('/') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('lapangan') }}">Lapangan</a>
              </li>
            </ul>
            <div class="d-fex">
                @guest('customer')
                    <a class="btn btn-primary btn-sm" href="{{ route('customer.login.form') }}">Login</a>
                    <a class="btn btn-outline-primary btn-sm" href="{{ route('customer.register.form') }}">Register</a>
                @endguest

                @auth('customer')
                <ul class="navbar-nav">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      {{ auth()->guard('customer')->user()->full_name }}
                    </a>
                    <ul class="dropdown-menu end-0 right-menu">
                      <li><a class="dropdown-item" href="{{ route('customer.booking.list') }}">Booking Saya</a></li>
                      <!-- <li><a class="dropdown-item" href="#">Akun</a></li> -->
                      <li><hr class="dropdown-divider"></li>
                      <li>
                        <form action="{{ route('customer.logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger" href="#">Logout</button>
                        </form>
                      </li>
                    </ul>
                  </li>
                </ul>

                @endauth
            </div>
          </div>
        </div>
    </nav>
    @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Selamat!</strong> {{ session()->get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if(session()->has('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Maaf!</strong> {{ session()->get('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="mb-4"></div>
    @yield('content')

    <p class="text-center mt-5">© 2022 – My Stadium Futsal Bali</p>

    @vite('resources/js/app.js')
    <script src="{{ asset('js/booking-checker.js') }}"></script>
</body>
</html>