<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIBARA | Kejaksaan Negeri Denpasar</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  </head>

  <body>
    <nav class="navbar py-1 sticky-top" style="background-color: #198754;">
      <div class="container d-flex justify-content-between align-items-center">
          <ul class="nav me-auto">
              <li class="nav-item"><a href="/" class="nav-link px-2 {{ ($title === "Beranda") ? 'active' : '' }}" aria-current="page">Beranda</a></li>
              <li class="nav-item"><a href="/barang" class="nav-link px-2 {{ ($title === "Barang") ? 'active' : '' }}">Barang Rampasan</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 {{ ($title === "Jadwal") ? 'active' : '' }}">Jadwal</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 {{ ($title === "Pengumuman") ? 'active' : '' }}">Pengumuman</a></li>
          </ul>
          <ul class="nav">
            @auth
              <li class="nav-item dropdown">
                <a href="#" class="nav-link px-2 dropdown-toggle {{ ($title === "Profile") ? 'active' : '' }}" role="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">&nbsp;Selamat Datang, {{ auth()->user()->pembeli->nama_pembeli }}</a>
                <ul class="dropdown-menu dropdown-menu-end">
                    {{-- Konten Dropdown --}}
                    <li><a class="dropdown-item" href="/account/profile/edit"><i class="fa fa-user"></i>&nbsp;My Profile</a></li>
                    <li><a class="dropdown-item" href="/logout"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
                </ul>
              </li>
            @endauth

            @guest
              <li class="nav-item"><a href="/account/login" class="nav-link px-2 {{ ($title === "Masuk") ? 'active' : '' }}"><i class="fa fa-sign-in"></i>&nbsp;Masuk</a></li>
              <li class="nav-item"><a href="/account/register" class="nav-link px-2 {{ ($title === "Daftar") ? 'active' : '' }}"><i class="fa fa-edit"></i>&nbsp;Daftar</a></li>
            @endguest
          </ul>

      </div>
    </nav>
  
    <header class="py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-6 d-flex align-items-center ">
            <a href="/"><img src="{{ asset('images/logo.png') }}" alt="logo" class="logo"></a>
            <div>
                <h6 class="mb-0" style="font-weight: normal;">Sistem Informasi Penjualan Langsung Barang Rampasan Negara</h6>
                <strong><h4 class="mt-0">Kejaksaan Negeri Denpasar</h4></strong>
            </div>
          </div>
          <div class="col-md-6 d-flex align-items-center">
            <div class="input-group">
              <input type="search" class="form-control" placeholder="Pencarian..." aria-label="Search">
              <button type="submit" class="btn btn-outline-secondary">
                  <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </header>
  
  
  
  

    @yield('content')





    <div class="container-fluid mt-5" style="background-color: #198754">
      <div class="container">
        <footer class="py-4" style="width: 100%; color:#ffff">
          <div class="row">

            <div class="col-md-5 mb-3">
              
              <h5>Hubungi Kami</h5>
  
              <ul class="nav flex-column" style="margin-top: 0px">
                <li class="nav-item mb-2 d-flex align-items-start">
                  <p class="mb-0"><strong>Kejaksaan Negeri Denpasar</strong></p>
                </li>
                <li class="nav-item mb-2 d-flex">
                  <i class="fa fa-map-marker d-flex align-items-center" style="margin-right: 10px"></i>
                    Jl. Jend. Sudirman No.3, Dauh Puri, Kec. Denpasar Barat, Kota Denpasar, Bali
                </li>
                <li class="nav-item mb-2 d-flex align-items-center">
                  <i class="fa fa-phone mr-2" style="margin-right: 10px"></i> (0361) 221999
                </li>
                <li class="nav-item mb-2 d-flex align-items-center">
                  <i class="fa fa-envelope mr-2" style="margin-right: 10px" ></i> kejari.denpasar@kejaksaan.go.id
                </li>
                <li class="nav-item mb-2 d-flex align-items-center">
                  <i class="fa fa-globe mr-2" style="margin-right: 10px"></i>
                  <a href="https://kejari-denpasar.kejaksaan.go.id" style="text-decoration: none; color: #ffff">https://kejari-denpasar.kejaksaan.go.id</a>
                </li>
              </ul>   
            </div>

            <div class="col-md-7 mb-3">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.2621689058565!2d115.21492377575345!3d-8.666598688207003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd2409472b2490d%3A0x2791325cdb59f509!2sKejaksaan%20Negeri%20Denpasar!5e0!3m2!1sid!2sid!4v1702998625970!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          
          <div class="d-flex flex-column flex-sm-row justify-content-between py-4 border-top">
            <p>Copyright &copy; 2023 Kejari Denpasar</p>
            <ul class="list-unstyled d-flex">
              <li class="ms-3"> Designed by ssuartanaya</li>
            </ul>
          </div>
        </footer>
      </div>
    </div>

      
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <script src="https://kit.fontawesome.com/513e5e702d.js" crossorigin="anonymous"></script>

    <script src="{{ asset('js/yscountdown.min.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>

  </body>
</html>