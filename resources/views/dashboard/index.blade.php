@extends('dashboard.layouts.main')


@section('content')


<!-- Modal -->
@if($jadwal)
  @if($status == 'range_jadwal' || $status == 'coming_soon')
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="bumperModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-body" style="position: relative; padding: 0px">
              @if($status == 'coming_soon')
                <a href="/jadwal" style="text-decoration: none;"><img src="{{ asset('images/banner 4.jpg') }}" class="d-block w-100" alt="..."></a>
              @elseif($status == 'range_jadwal')
                <a href="/jadwal" style="text-decoration: none;"><img src="{{ asset('images/banner 1.jpg') }}" class="d-block w-100" alt="..."></a>
              @endif
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; top: 0; right: 0;"></button>
          </div>
        </div>
      </div>
    </div>
  @endif
@endif


<div class="container-fluid cover" style="background-image: url('{{ asset('images/bg-carousel.jpg') }}');">
  <div class="container">

    {{-- Alert  --}}
    
    @if(session('success'))
      <div class="alert alert-success custom-alert alert-dismissible fade show" role="alert">
        <div class="text-center">
          <strong>Terimakasih, mohon menunggu sampai data Anda terverifikasi.</strong>
          <p>Kami akan menghubungi anda lewat Whatsapp jika data anda sudah berhasil terverifikasi</p>
        </div> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="row justify-content-md-center py-5">
      <div class="col-md-12">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            @if($jadwal)
              @if($status == 'range_jadwal' || $status == 'coming_soon')
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
              @endif
            @endif
          </div>
          <div class="carousel-inner">
            @if ($jadwal)
              @if ($status == 'range_jadwal')
                <div class="carousel-item active">
                  <a href="/jadwal" style="text-decoration: none;"><img src="{{ asset('images/banner 1.jpg') }}" class="d-block w-100" alt="..."></a>
                </div>
                <div class="carousel-item">
                  <img src="{{ asset('images/banner 2.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="{{ asset('images/banner 3.jpg') }}" class="d-block w-100" alt="...">
                </div>
              @elseif ($status == 'coming_soon')
                <div class="carousel-item active">
                  <a href="/jadwal" style="text-decoration: none;"><img src="{{ asset('images/banner 4.jpg') }}" class="d-block w-100" alt="..."></a>
                </div>
                <div class="carousel-item">
                  <img src="{{ asset('images/banner 2.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="{{ asset('images/banner 3.jpg') }}" class="d-block w-100" alt="...">
                </div>
              @else
                <div class="carousel-item active">
                  <img src="{{ asset('images/banner 2.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="{{ asset('images/banner 3.jpg') }}" class="d-block w-100" alt="...">
                </div>
              @endif
            @else
              <div class="carousel-item active">
                <img src="{{ asset('images/banner 2.jpg') }}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{ asset('images/banner 3.jpg') }}" class="d-block w-100" alt="...">
              </div>
            @endif
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container py-5">

  <div class="row">

    <div class="col-md-12">
      <h2 class="section-title">Jadwal Penjualan Langsung</h2>
      <div class="centered-icon">
        <hr>
        <div class="icon"><i class="fa-solid fa-gavel fa-2xl" style="color: #198754;"></i></i></div>
      </div>
      
      <div class="row py-2">

        @if ($jadwal)
          @if ($status == 'coming_soon')
            <h4 class="text-center">
              <span class="badge text-bg-success">Penjualan Langsung Mendatang!</span>
            </h4>

            <div class="col-md-3">
              <div class="card border-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      <h1><i class="fa-regular fa-calendar-days"></i> </h1>
                    </div>
                    <div class="col-md-10">
                      <strong><p style="margin-bottom: 0px">Hari:</p></strong>
                      <p>{{ $jadwal->start_date->format('l') }} - {{ $jadwal->end_date->format('l') }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card border-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      <h1><i class="fa-regular fa-calendar-check"></i> </h1>
                    </div>
                    <div class="col-md-10">
                      <strong><p style="margin-bottom: 0px">Tanggal:</p></strong>
                      <p>{{ $jadwal->start_date->format('j M Y') }} - {{ $jadwal->end_date->format('j M Y') }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card border-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      <h1><i class="fa-regular fa-clock"></i> </h1>
                    </div>
                    <div class="col-md-10">
                      <strong><p style="margin-bottom: 0px">Waktu:</p></strong>
                      <p>{{ $jadwal->start_date->format('H:i') }} - {{ $jadwal->end_date->format('H:i') }} WITA</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-3">
              <div class="card border-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      <h1><i class="fa-solid fa-location-dot"></i> </h1>
                    </div>
                    <div class="col-md-10">
                      <strong><p style="margin-bottom: 0px">Tempat:</p></strong>
                      <p>Kejaksaan Negeri Denpasar</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            

          @elseif ($status == 'range_jadwal')
            <p id="end_date" dataEndDate= {{ $jadwal->end_date->toIso8601String() }}></p>
            <div class="badge-container">
              <h4 class="text-center">
                <strong>Lelang Penjualan Langsung Barang Rampasan Negara</strong>
                <p class="text-secondary" style="margin-top: 5px; margin-bottom: 0px; ">Berakhir dalam: <strong id="countdown" class="text-danger"></strong>
                </p>
                <strong>
                  <p style="margin-top: 0px">
                    <a href="/jadwal" class="text-success" style="text-decoration: none; font-size: 15pt">Lihat Daftar Barang</a>
                  </p>
                </strong>
              </h4>
            </div>
            
            <div id="hide_countdown" class="row">
              <div class="col-md-3">
                <div class="card border-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-2">
                        <h1><i class="fa-regular fa-calendar-days"></i> </h1>
                      </div>
                      <div class="col-md-10">
                        <strong><p style="margin-bottom: 0px">Hari:</p></strong>
                        <p>{{ $jadwal->start_date->format('l') }} - {{ $jadwal->end_date->format('l') }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
  
              <div class="col-md-3">
                <div class="card border-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-2">
                        <h1><i class="fa-regular fa-calendar-check"></i> </h1>
                      </div>
                      <div class="col-md-10">
                        <strong><p style="margin-bottom: 0px">Tanggal:</p></strong>
                        <p>{{ $jadwal->start_date->format('j M Y') }} - {{ $jadwal->end_date->format('j M Y') }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
  
              <div class="col-md-3">
                <div class="card border-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-2">
                        <h1><i class="fa-regular fa-clock"></i> </h1>
                      </div>
                      <div class="col-md-10">
                        <strong><p style="margin-bottom: 0px">Waktu:</p></strong>
                        <p>{{ $jadwal->start_date->format('H:i') }} - {{ $jadwal->end_date->format('H:i') }} WITA</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-md-3">
                <div class="card border-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-2">
                        <h1><i class="fa-solid fa-location-dot"></i> </h1>
                      </div>
                      <div class="col-md-10">
                        <strong><p style="margin-bottom: 0px">Tempat:</p></strong>
                        <p>Kejaksaan Negeri Denpasar</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {{-- <div class="col-md-12 text-center">
                <button class="btn btn-secondary">Cek Daftar Barang Yang Dijual</button>
              </div> --}}
            </div>

            <div id="end_event" style="display: none">
              <h5 class="text-center">
                Penjualan Langsung sudah berakhir.
                <p>Nantikan jadwal selanjutnya.</p>
              </h5>
            </div>
          
          @elseif ($status == 'past_event')
            <h4 class="text-center">
              Penjualan Langsung sudah berakhir.
              <p>Nantikan jadwal selanjutnya.</p>
            </h4>
          @endif

        @else
          <h4 class="text-center">
            Saat ini belum ada Jadawal Penjualan Langsung Barang Rampasan Negara
            <p>Nantikan jadwal selanjutnya.</p>
          </h4>
        @endif

      </div>
    </div>

  </div>

</div>

<div class="container py-2">
  <div class="row">
    <div class="col-md-12 d-flex align-items-center">
      <h2 class="section-title2">Alur Lelang</h2>
      <hr class="flex-grow-1 mx-2">
    </div>
  </div>
  <div class="row py-5">
    <div class="col-md-3 step-container">
      <div class="step">
        <i class="fas fa-user fa-2x mb-2"></i>
        <h4 class="mt-4 text-left">Daftar Akun</h4>
        <p class="text-secondary">Untuk dapat melakukan proses lelang, anda harus mendaftar terlebih dahulu. Proses pendaftaran gratis dan sangat mudah</p>
      </div>
    </div>
    <div class="col-md-3 step-container">
      <div class="step">
        <i class="fa-solid fa-calendar-day fa-2x mb-2"></i>
        <h4 class="mt-4 text-left">Jadwal</h4>
        <p class="text-secondary">Penawaran terbatas, lelang hanya dibuka saat jadwal penjualan langsung tersedia. </p>
      </div>
    </div>
    <div class="col-md-3 step-container">
      <div class="step">
        <i class="fas fa-rupiah-sign fa-2x mb-2"></i>
        <h4 class="mt-4 text-left">Penawaran</h4>
        <p class="text-secondary">Anda dapat langsung mengajukan penawaran pada produk apa pun yang diinginkan, ketika jadwal lelang penjualan langsung tersedia.</p>
      </div>
    </div>
    <div class="col-md-3 step-container">
      <div class="step">
        <i class="fas fa-trophy fa-2x mb-2"></i>
        <h4 class="mt-4 text-left">Menang</h4>
        <p class="text-secondary">Menangkan lelang kami dengan mudah dan nikmati produk impian Anda setelah penawaran pada jadwal lelang penjualan langsung ditutup.</p>
      </div>
    </div>
  </div>
    
</div>


<div class="container py-2">
  <div class="row">
    <div class="col-md-12 d-flex align-items-center">
      <h2 class="section-title2">Barang Rampasan Terbaru</h2>
      <hr class="flex-grow-1 mx-2">
    </div>
  </div>

  <div class="row py-4">
    @if ($daftar_barang->isNotEmpty())
      @foreach ($daftar_barang as $daftar)
      {{-- dapatkan harga terakhir --}}
      @php
        $latestHarga = $harga_terakhir[$daftar->id];
        $firstHarga = $harga_awal[$daftar->id];
      @endphp
      <div class="col-md-3 mb-4">
        <div class="card shadow-sm position-relative">
          {{-- <img class="bd-placeholder-img card-img-top" src="asset{{ $daftar->barang_rampasan->foto_thumbnail }}" style="object-fit: cover; width: 100%; height: 300px;"  alt="Your Alt Text"> --}}
          <a href="/detail/{{ $daftar->id }}"><img class="bd-placeholder-img card-img-top" src="http://admin.sibara.test{{ $daftar->foto_thumbnail }}" style="object-fit: cover; width: 100%; height: 300px;"  alt="Your Alt Text"></a>

          {{-- <div class="position-absolute top-0 start-0 m-3">
            <span class="badge bg-danger" style="border-radius: 4px;">Sale!</span>
          </div> --}}

          <div class="card-body d-flex" style="background-color: #F4F4F2; display: flex; flex-direction: column;">
            <a href="/detail/{{ $daftar->id }}" class="text-decoration-none text-dark"><h6 class="text-left mb-2" style="flex-shrink: 0;">
              {{ \Illuminate\Support\Str::limit($daftar->nama_barang, 65, '...') }}</a></h6>
            <p class="text-secondary mb-2">{{ $daftar->kategori->nama_kategori }}</p>
            
            @if ($daftar->harga_wajar->count() > 1)
              <div class="d-flex align-item-center">
                <p class="text-decoration-line-through text-secondary" style="margin-bottom: 0px">
                  Rp. {{ number_format($firstHarga->harga, 0, ',', '.') }}
                </p>

                {{-- Menghitung persentase pengurangan --}}
                @if ($firstHarga->harga && $latestHarga->harga)
                  @php
                    $persentase_pengurangan = (($firstHarga->harga - $latestHarga->harga) / $firstHarga->harga) * 100;
                  @endphp
                @endif
                {{-- ... --}}
                
                &nbsp;<span class="badge text-bg-danger" style="margin-bottom: 0px; font-weight: bold; display: flex; align-items: center; justify-content: center;">{{ number_format($persentase_pengurangan) }}% </span>
              </div>
            @else
              <div class="mb-2" style="height: 17px; flex-shrink: 0;"></div>
            @endif
            
            <div class="d-flex justify-content-between align-items-start mb-2">
              <h4 class="mb-0"><strong>Rp. {{ number_format($latestHarga->harga, 0, ',', '.') }}</strong></h4>
              <a href="/detail/{{ $daftar->id }}"><button class="btn btn-sm btn-outline-success">Detail Barang</button></a>
            </div>
            
            {{-- <div class="text-center mt-2">
              <a href="/detail/{{ $daftar->id }}"><button class="btn btn-sm btn-outline-success">Detail Barang</button></a>
            </div> --}}
          </div>
        
        
        </div>
      </div>
      @endforeach

    @else
      <h5 class="text-center">
        Saat ini belum ada Barang Rampasan Negara Terdaftar
      </h5>
    @endif
  </div>
    
</div>

@endsection