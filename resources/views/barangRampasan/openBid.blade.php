<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta property="og:url" content="https://sipbaran.com/detail/{{ $data_barang->id }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Lelang {{ $data_barang->nama_barang }}" />
    <meta property="og:description" content="{{ $data_barang->deskripsi }}" />
    <meta property="og:image" content="{{ $data_barang->foto_thumbnail }}" />
    <meta property="fb:app_id" content="1061593204925899" />

    <title>SIPBARAN | Kejaksaan Negeri Denpasar</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo2.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  </head>

  <body>
    <nav class="navbar py-1 sticky-top" style="background-color: #198754;">
      <div class="container d-flex justify-content-between align-items-center">
          <ul class="nav me-auto">
              <li class="nav-item"><a href="/" class="nav-link px-2 {{ ($title === "Beranda") ? 'active' : '' }}" aria-current="page">Beranda</a></li>
              <li class="nav-item"><a href="/barang" class="nav-link px-2 {{ ($title === "Barang") ? 'active' : '' }}">Barang Rampasan</a></li>
              <li class="nav-item"><a href="/jadwal" class="nav-link px-2 {{ ($title === "Jadwal") ? 'active' : '' }}">Jadwal</a></li>
              <li class="nav-item"><a href="/pengumuman" class="nav-link px-2 {{ ($title === "Pengumuman") ? 'active' : '' }}">Pengumuman</a></li>
          </ul>
          <ul class="nav">
            @auth
              @php
                $productCount = isset($statusPenawaran['productCount']) ? $statusPenawaran['productCount'] : null;
                $notifCount = isset($notif['transaksi']) ? $notif['transaksi'] : null;
              @endphp
              
              {{-- cart icon --}}

              @if ($productCount)
                @if($productCount->isNotEmpty())
                  <li class="nav-item special-nav-item">
                    <a href="" class="nav-link position-relative">
                      <i class="fa-solid fa-cart-shopping"></i>
                      <span style="position: absolute; top: 0px; left: 80%; transform: translateX(-50%);" class="badge rounded-pill bg-danger">
                        {{ $productCount->count() }}
                      </span>
                    </a>
                    <div class="dropdown-content">
                      <div class="card">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item" style="font-weight: bold">Penawaran anda:</li>
                          @foreach($productCount as $penawaran)
                            <a href="/detail/{{ $penawaran->id_barang }}" class="text-decoration-none text-dark"><li class="list-group-item" style="font-size: 10pt">{{ $penawaran->barang_rampasan->nama_barang }}</li></a>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </li>
                @else
                  <li class="nav-item">
                    <a href="" class="nav-link position-relative">
                      <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                  </li>
                @endif
              @else
                <li class="nav-item"><a href="" class="nav-link px-2"><i class="fa-solid fa-cart-shopping"></i></a></li>
              @endif

              {{-- notification icon --}}

              @if ($notifCount)
                @if($notifCount->isNotEmpty())
                  <li class="nav-item special-nav-item">
                    <a href="" class="nav-link position-relative">
                      <i class="fa-solid fa-bell"></i>
                      <span style="position: absolute; top: 0px; left: 80%; transform: translateX(-50%);" class="badge rounded-pill bg-danger">
                        {{ $notifCount->count() }}
                      </span>
                    </a>
                    <div class="dropdown-content">
                      <div class="card">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item" style="font-weight: bold">Menunggu Pembayaran:</li>
                          @foreach($notifCount as $notif)
                            <a href="/pembayaran" class="text-decoration-none text-dark"><li class="list-group-item" style="font-size: 10pt">{{ $notif->barang_rampasan->nama_barang }}</li></a>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </li>
                @else
                  <li class="nav-item">
                    <a href="" class="nav-link position-relative">
                      <i class="fa-solid fa-bell"></i>
                    </a>
                  </li>
                @endif
              @else
                <li class="nav-item"><a href="" class="nav-link px-2"><i class="fa-solid fa-bell"></i></a></li>
              @endif
              
              <li class="nav-item dropdown">
                <a href="#" class="nav-link px-2 dropdown-toggle {{ ($title === "Profile") ? 'active' : '' }}" role="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">&nbsp;Selamat Datang, {{ auth()->user()->pembeli->nama_pembeli }}</a>
                <ul class="dropdown-menu dropdown-menu-end">
                    {{-- Konten Dropdown --}}
                    <li><a class="dropdown-item" href="/account/profile"><i class="fa fa-user"></i>&nbsp;My Profile</a></li>
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
            <form action="/filter" class="w-100" method="GET">
            @csrf
              <div class="input-group">
                <input type="search" name="search" class="form-control" placeholder="Pencarian..." aria-label="Search" 
                value="{{ isset($request) ? $request->input('search') : '' }}">
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="fa fa-search"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </header>



    <div class="container py-4">
      <div class="row">
        <div class="col-md-12 d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-secondary">Beranda</a></li>
              <li class="breadcrumb-item"><a href="/barang" class="text-decoration-none text-secondary">Barang Rampasan</a></li>
              <li class="breadcrumb-item" aria-current="page">Detail Barang</li>
            </ol>
          </nav>
        </div>
      </div>

      @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('message')['text'] }}
            @if(session('message')['url'])
              <a href="{{ session('message')['url'] }}">Lihat semua penawaran</a>
            @endif
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="row">
        <div class="col-md-5">
          <div id="produkCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="magnifying-glass"></div>
            <div class="carousel-inner">
              @foreach($foto_barang as $index => $foto)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img class="d-block w-100" src="{{ $foto }}" alt="Foto {{ $index + 1 }}">
                </div>
              @endforeach
            </div>
          </div>
          <div class="image-preview" id="thumbnailCarousel">
            @foreach ($foto_barang as $index => $foto)
              <img src="{{ $foto }}" class="thumbnail" data-bs-target="#produkCarousel" data-bs-slide-to="{{ $index }}" alt="Thumbnail {{ $index + 1 }}">
            @endforeach
          </div>
        </div>

        <div class="col-md-4">

          <h5 style="font-weight: bold">{{ $data_barang->nama_barang}}</h4>

          @if ($data_barang->harga_wajar->count() > 1)
            <div class="d-flex align-item-center">
              <p class="text-decoration-line-through text-secondary" style="margin-bottom: 0px;">
                Rp. {{ number_format($data_barang->harga_wajar->first()->harga, 0, ',', '.') }}</p>&nbsp;

              {{-- Menghitung persentase pengurangan --}}
                  @php
                  $persentase_pengurangan = (($data_barang->harga_wajar->first()->harga - $data_barang->harga_wajar->last()->harga) 
                  / $data_barang->harga_wajar->first()->harga) * 100;
                @endphp
              {{-- ... --}}

              <span class="badge text-bg-danger" style="margin-bottom: 0px; font-weight: bold; display: flex; align-items: center; justify-content: center;">
                {{ number_format($persentase_pengurangan) }}% </span>
            </div>
          @endif

          <h3><strong>Rp. {{ number_format($data_barang->harga_wajar->last()->harga, 0, ',', '.') }}</strong></h3>
          <hr class="mb-1">

          <h5>Penawaran: </h5>
          <p style="font-size: 11pt; font-weight: bold">Open Bidding</p>
          
          <h5>Deskripsi: </h5>
          <p style="font-size: 11pt">{{ $data_barang->deskripsi }}</p>

          <h5 class="mb-2 mt-3 align-self-center">Bagikan:&nbsp; </h5> 
          
          <a href="#" class="btn btn-sm btn-primary mb-3 share-facebook" data-url="https://sipbaran.com/detail/{{ $data_barang->id }}">
            <i class="fab fa-facebook"></i>&nbsp;Facebook
          </a>

          <a href="https://api.whatsapp.com/send?text=Lelang%20{{ $data_barang->nama_barang }}%20%7C%20Sibara%20http%3A%2F%2Fsibara.test%2Fdetail%2F{{ $data_barang->id }}" class="btn btn-sm btn-success mb-3">
            <i class="fab fa-whatsapp"></i>&nbsp;WhatsApp
          </a>

          @if($tawaran->isNotEmpty())
            <h5>Penawar Tertinggi: </h5>
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Penawar</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Waktu</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tawaran as $index => $penawaran)
                  <tr class="{{ $loop->first && $tawaran->currentPage() == 1 ? 'table-active' : '' }}">
                    <td>{{ ($tawaran->currentPage() - 1) * $tawaran->perPage() + $loop->iteration }}</td>
                    <td>{{ $penawaran->pembeli->nama_pembeli }}</td>
                    <td>Rp. {{ number_format($penawaran->harga_bid, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($penawaran->created_at)->format('j M Y \j\a\m H:i') }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @else
            <h5>Urutan Penawar Tertinggi: </h5>
            <p style="font-size: 11pt">Belum terdapat penawar</p>
          @endif 
          
          {{ $tawaran->links('pagination::bootstrap-5') }}

        </div>

        <div class="col-md-3">
          @if($status == 'coming_soon')
            <div class="card">
              <div class="card-body">
                <h5 style="font-weight: bold; margin-bottom: 2px">Tawar Harga</h5>
                <p class="text-secondary">Tawaran Minimum Rp. {{ number_format($data_barang->harga_wajar->last()->harga, 0, ',', '.') }}</p>
                <form action="#" method="get">
                  <div class="input-group mb-3">
                    <span class="input-group-text">Rp.</span>
                    <input type="text" id="penawaran" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-success mb-2 w-100" disabled><i class="fa fa-plus"></i> &nbsp;Ajukan Tawaran</button>
                </form>
              </div>
            </div>
            <div class="card mt-3">
              <div class="card-body">
                <h5 style="font-weight: bold; margin-bottom: 2px">Pelaksanaan Lelang Mendatang:</h5>
                <p class="text-secondary mb-0" style="font-size: 11pt">
                  {{ \Carbon\Carbon::parse($jadwal->start_date)->translatedFormat('j F Y \j\a\m H:i') }} s/d </p>
                <p class="text-secondary mb-0" style="font-size: 11pt">
                  {{ \Carbon\Carbon::parse($jadwal->end_date)->translatedFormat('j F Y \j\a\m H:i') }} WITA</p>
              </div>
            </div>
            <div class="card mt-3">
              <div class="card-body">
                <h5 style="font-weight: bold; margin-bottom: 2px">Waktu Server</h5>
                <p class="text-secondary mb-0">
                  <i class="fa fa-clock-o"></i>
                  <span id="currentDate"></span>
                </p>
                <p class="text-secondary mb-0" id="currentTime"></p>
              </div>
            </div>
            
          @elseif($status == 'range_jadwal')
            <div class="badge-container">
              <p class="text-secondary mt-0" style="margin-top: 5px; margin-bottom: 0px; ">Berakhir dalam: <strong id="countdown" class="text-danger"></strong>
              </p>
            </div>
            <p id="end_date" dataEndDate= {{ $jadwal->end_date->toIso8601String() }}></p>

            <div id="hide_countdown">
              <div class="card mt-3">
                <div class="card-body">
                  
                  <h5 style="font-weight: bold; margin-bottom: 2px">Tawar Sekarang</h5>
                  <p class="text-secondary">Tawaran Minimum Rp. {{ number_format($data_barang->harga_wajar->last()->harga, 0, ',', '.') }}</p>
                  @auth
                    <form action="/penawaran" method="post">
                      @csrf
                      <div class="col-auto">
                        <div class="input-group mb-3">
                          <span class="input-group-text">Rp.</span>
                          <input type="text" id="penawaran" name="harga_bid" class="form-control 
                            @error('harga_bid') is-invalid @enderror" value="{{ old('harga_bid') }}">
                            @error('harga_bid')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          <input type="hidden" class="form-control" id="penawaran" name="id_barang" value="{{ $data_barang->id }}">
                          <input type="hidden" class="form-control" id="penawaran" name="current_price" value="{{ $data_barang->harga_wajar->last()->harga }}">
                          <input type="hidden" class="form-control" id="penawaran" name="id_pembeli" value="{{ auth()->user()->pembeli->id }}">
                          <input type="hidden" class="form-control" id="penawaran" name="id_jadwal" value="{{ $jadwal->id }}">
                        </div>
                        <button type="submit" class="btn btn-success mb-2 w-100"><i class="fa fa-plus"></i> &nbsp;Ajukan Tawaran</button>
                      </div>
                    </form>
                  @else
                    <form action="/account/login" method="get">
                      <div class="col-auto">
                        <div class="input-group mb-3">
                          <span class="input-group-text">Rp.</span>
                          <input type="text" class="form-control" id="penawaran">
                        </div>
                        <button type="submit" class="btn btn-success mb-2 w-100"><i class="fa fa-plus"></i> &nbsp;Ajukan Tawaran</button>
                      </div>
                    </form>
                  @endauth
                  
                </div>
              </div>
              <div class="card mt-3">
                <div class="card-body">
                  <h5 style="font-weight: bold; margin-bottom: 2px">Pelaksanaan Lelang:</h5>
                  <p class="text-secondary mb-0" style="font-size: 11pt">
                    {{ \Carbon\Carbon::parse($jadwal->start_date)->translatedFormat('j F Y \j\a\m H:i') }} s/d </p>
                  <p class="text-secondary mb-0" style="font-size: 11pt">
                    {{ \Carbon\Carbon::parse($jadwal->end_date)->translatedFormat('j F Y \j\a\m H:i') }} WITA</p>
                </div>
              </div>
            </div>

            <div class="card mt-3">
              <div class="card-body">
                <h5 style="font-weight: bold; margin-bottom: 2px">Waktu Server</h5>
                <p class="text-secondary mb-0">
                  <i class="fa fa-clock-o"></i>
                  <span id="currentDate"></span>
                </p>
                <p class="text-secondary mb-0" id="currentTime"></p>
              </div>
            </div>

          @else
            <div class="card">
              <div class="card-body">
                <h5 style="font-weight: bold; margin-bottom: 2px">Waktu Server</h5>
                <p class="text-secondary mb-0">
                  <i class="fa fa-clock-o"></i>
                  <span id="currentDate"></span>
                </p>
                <p class="text-secondary mb-0" id="currentTime"></p>
              </div>
            </div>
            
            
          @endif

          
        </div>
        
      </div>
      
    </div>



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

