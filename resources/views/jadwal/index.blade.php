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
    @if ($daftar_barang->isNotEmpty())
      @foreach ($daftar_barang as $daftar)
        <div class="col-md-3 py-3">
          <div class="card">
            <a href="/detail/{{ $daftar->barang_rampasan->id }}"><img class="bd-placeholder-img card-img-top" src="http://admin.sibara.test{{ $daftar->barang_rampasan->foto_thumbnail }}" style="object-fit: cover; width: 100%; height: 300px;"  alt="Your Alt Text"></a>
            <div class="card-body d-flex" style="background-color: #f8f9fa; display: flex; flex-direction: column;">
              <a href="/detail/{{ $daftar->barang_rampasan->id }}" class="text-decoration-none text-dark">
                <h6 class="text-left mb-2" style="flex-shrink: 0;">
                {{ \Illuminate\Support\Str::limit($daftar->barang_rampasan->nama_barang, 65, '...') }}</h6></a>
              <p class="text-secondary mb-2">{{ $daftar->barang_rampasan->kategori->nama_kategori }}</p>

              @if ($daftar->barang_rampasan->harga_wajar->count() > 1)
                <div class="d-flex align-item-center">
                  <p class="text-decoration-line-through text-secondary" style="margin-bottom: 0px">
                    Rp. {{ number_format($daftar->barang_rampasan->harga_wajar->first()->harga, 0, ',', '.') }}
                  </p>

                  {{-- Menghitung persentase pengurangan --}}
                  @php
                    $firstHarga = $daftar->barang_rampasan->harga_wajar->first()->harga;
                    $lastHarga = $daftar->barang_rampasan->harga_wajar->last()->harga;

                    $persentase_pengurangan = (($firstHarga - $lastHarga) / $firstHarga) * 100;
                  @endphp
                  {{-- ... --}}
                  
                  &nbsp;<span class="badge text-bg-danger" style="margin-bottom: 0px; font-weight: bold; display: flex; align-items: center; justify-content: center;">{{ number_format($persentase_pengurangan) }}% </span>
                </div>
              @else
                <div class="mb-2" style="height: 17px; flex-shrink: 0;"></div>
              @endif

              <div class="d-flex justify-content-between align-items-start mb-2">
                <h4 class="mb-0"><strong>Rp. {{ number_format($daftar->barang_rampasan->harga_wajar->last()->harga, 0, ',', '.') }}</strong></h4>
                <p class="text-secondary mb-0">0 <i class="fa fa-user"></i></p>
              </div>

              <div class="text-center mt-2">
                <a href="/detail/{{ $daftar->barang_rampasan->id }}"><button class="btn btn-sm btn-outline-success">Detail Barang</button></a>
              </div>

            </div>
          </div>
        </div>
      @endforeach 

      <div>
        {{ $daftar_barang->links('pagination::bootstrap-5') }}
      </div>
      
    @else
      Tidak ada barang lelang
    @endif
  </div>
</div>

@endsection