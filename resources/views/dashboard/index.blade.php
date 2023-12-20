@extends('dashboard.layouts.main')


@section('content')

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
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="{{ asset('images/banner 2.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="{{ asset('images/banner 3.jpg') }}" class="d-block w-100" alt="...">
            </div>
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

    <div class="col-md-4 offset-md-2">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title text-center">
            Jadwal Penjualan Langsung
          </h4>
        </div>
        <div class="card-body">
          <div class="card-text">
            @if ($jadwal)
              @if ($status == 'coming_soon')
                <h5 class="text-center mb-4">
                  <span class="badge text-bg-success">Penjualan Langsung Mendatang!</span></h5>
                <p style="margin-bottom: 5px;">
                  <i class="fa-regular fa-calendar-days"></i> Hari:  {{ $jadwal->start_date->format('l') }} - {{ $jadwal->end_date->format('l') }}</p>
                <p style="margin-bottom: 5px;">
                  <i class="fa-solid fa-calendar-check"></i> Tanggal:  {{ $jadwal->start_date->format('j F Y') }} - {{ $jadwal->end_date->format('j F Y') }}</p>
                <p style="margin-bottom: 5px;">
                  <i class="fa-regular fa-clock"></i> Waktu:  {{ $jadwal->start_date->format('H:i') }} - {{ $jadwal->end_date->format('H:i') }} WITA</p>
                <p style="margin-bottom: 5px;">
                  <i class="fa-solid fa-location-dot"></i> Tempat:  Kejaksaan Negeri Denpasar</p>

              @elseif ($status == 'range_jadwal')
                <h5 class="text-center mb-4">
                  <div id="countdown" class="text-danger"></div></span>
                </h5>
                <div id="hide_countdown">
                  <p id="end_date" dataEndDate= {{ $jadwal->end_date->toIso8601String() }}></p>

                  <p style="margin-bottom: 5px;">
                    <i class="fa-regular fa-calendar-days"></i> Hari:  {{ $jadwal->start_date->format('l') }} - {{ $jadwal->end_date->format('l') }}</p>
                  <p style="margin-bottom: 5px;">
                    <i class="fa-solid fa-calendar-check"></i> Tanggal:  {{ $jadwal->start_date->format('j F Y') }} - {{ $jadwal->end_date->format('j F Y') }}</p>
                  <p style="margin-bottom: 5px;">
                    <i class="fa-regular fa-clock"></i> Waktu:  {{ $jadwal->start_date->format('H:i') }} - {{ $jadwal->end_date->format('H:i') }} WITA</p>
                  <p >
                    <i class="fa-solid fa-location-dot"></i> Tempat:  Kejaksaan Negeri Denpasar</p>
                </div>
                <div id="end_event" style="display: none">
                  <h6 class="text-center">
                    Penjualan Langsung sudah berakhir.
                    <p>Nantikan jadwal selanjutnya.</p>
                  </h6>
                </div>
                
              @elseif ($status == 'past_event')
                <h6 class="text-center">
                  Penjualan Langsung sudah berakhir.
                  <p>Nantikan jadwal selanjutnya.</p>
                </h6>
              @endif

            @else
              <p>
                Belum ada jadwal penjualan langsung.
              </p>
            @endif

          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <div class="card-title text-center text-success">
            <h4>Waktu Server</h4>
          </div> 
        </div>
        <div class="card-body">
          <div class="card-text text-center">
            <h5>
              <i class="fa fa-clock-o"></i>
              <span id="currentDate"></span>
            </h5>
            <p id="currentTime"></p>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

<div class="container py-3 mx-auto">
  <div class="row">
    <div class="col-md-4">
      <div class="card shadow-sm">
        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
        <div class="card-body">
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
            </div>
            <small class="text-body-secondary">9 mins</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm">
        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
        <div class="card-body">
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
            </div>
            <small class="text-body-secondary">9 mins</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm">
        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
        <div class="card-body">
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
            </div>
            <small class="text-body-secondary">9 mins</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection