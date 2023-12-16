<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIBARA | Welcome</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  </head>

  <body>
    <nav class="navbar py-1 sticky-top" style="background-color: #198754;">
      <div class="container d-flex justify-content-between align-items-center">
          <ul class="nav me-auto">
              <li class="nav-item"><a href="#" class="nav-link px-2 active" aria-current="page">Beranda</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2">Barang Rampasan</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2">Jadwal</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2">Pengumuman</a></li>
          </ul>
          <ul class="nav">
              <li class="nav-item"><a href="/account/login" class="nav-link px-2"><i class="fa fa-sign-in"></i>&nbsp;Masuk</a></li>
              <li class="nav-item"><a href="/account/register" class="nav-link px-2"><i class="fa fa-edit"></i>&nbsp;Daftar</a></li>
          </ul>
      </div>
    </nav>
  
    <header class="py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-6 d-flex align-items-center ">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="logo">
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





    <div class="container-fluid" style="background-color: #198754">
      <div class="container">
        <footer class="py-4" style="width: 100%; color:#ffff">
          <div class="row">
            <div class="col-6 col-md-4 mb-3">
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
                  <i class="fa fa-phone mr-2" style="margin-right: 10px"></i>
                  <a href="https://kejari-denpasar.kejaksaan.go.id" style="text-decoration: none; color: #ffff">https://kejari-denpasar.kejaksaan.go.id</a>
                </li>
              </ul>          
              
            </div>
         
            <div class="col-md-5 offset-md-1 mb-3">
              <form>
                <h5>Subscribe to our newsletter</h5>
                <p>Monthly digest of what's new and exciting from us.</p>
                <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                  <label for="newsletter1" class="visually-hidden">Email address</label>
                  <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                  <button class="btn btn-success" type="button">Subscribe</button>
                </div>
              </form>
            </div>
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
      



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  </body>
</html>