@extends('dashboard.layouts.main')


@section('content')

<div class="container py-4">
  <div class="row">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-secondary">Beranda</a></li>
        <li class="breadcrumb-item" aria-current="page">Jadwal Penjualan Langsung</li>
      </ol>
    </nav>

    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Jadwal Penjualan Langsung</h1>
        <p class="col-md-8 fs-4"></p>
        @if ($jadwal)
          @if ($status == 'coming_soon')
          <div class="badge-container">
            <h4 class="">
              <strong>Jadwal Lelang Mendatang</strong>
            </h4>
          </div>
          
          <div id="hide_countdown" class="row mt-3">
            <div class="col-md-3">
              <div class="row">
                <div class="col-sm-2">
                  <h1><i class="fa-regular fa-calendar-days"></i> </h1>
                </div>
                <div class="col-sm-10">
                  <strong><p style="margin-bottom: 0px">Hari:</p></strong>
                  <p>{{ $jadwal->start_date->format('l') }} - {{ $jadwal->end_date->format('l') }}</p>
                </div>
              </div>
            </div>

            <div class="col-md-3">
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

            <div class="col-md-3">
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
            
            <div class="col-md-3">
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
            

          @elseif ($status == 'range_jadwal')
            <p id="end_date" dataEndDate= {{ $jadwal->end_date->toIso8601String() }}></p>
            <div class="badge-container">
              <h4 class="">
                <strong>Lelang Penjualan Langsung Barang Rampasan Negara</strong>
                <p class="text-secondary" style="margin-top: 5px; margin-bottom: 0px; ">Berakhir dalam: <strong id="countdown" class="text-danger"></strong>
                </p>
              </h4>
            </div>
            
            <div id="hide_countdown" class="row mt-3">
              <div class="col-md-3">
                <div class="row">
                  <div class="col-sm-2">
                    <h1><i class="fa-regular fa-calendar-days"></i> </h1>
                  </div>
                  <div class="col-sm-10">
                    <strong><p style="margin-bottom: 0px">Hari:</p></strong>
                    <p>{{ $jadwal->start_date->format('l') }} - {{ $jadwal->end_date->format('l') }}</p>
                  </div>
                </div>
              </div>
  
              <div class="col-md-3">
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
  
              <div class="col-md-3">
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
              
              <div class="col-md-3">
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

          @elseif ($status == 'past_event')
            <h4>Penjualan Langsung sudah berakhir.</h4>
            <p>Nantikan jadwal selanjutnya.</p>
          @endif

        @else
          <h4>Saat ini belum ada Jadawal Penjualan Langsung Barang Rampasan Negara</h4>
          <p>Nantikan jadwal selanjutnya.</p>
        @endif
      </div>
    </div>

    <div class="col-md-12 d-flex align-items-center">
      <h2 class="section-title2">Daftar Barang Lelang</h2>
      <hr class="flex-grow-1 mx-2">
    </div>
  </div>
</div>

@endsection