@extends('dashboard.layouts.main')


@section('content')
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

  <div class="row">
    <div class="col-md-3">
      <div class="card py-2">
        <div class="card-header">
          <h6><strong class="text-uppercase">waktu server</strong></h6>
        </div>
        <div class="card-body text-center">
          <h5>
            <i class="fa fa-clock-o"></i>
            <span id="currentDate"></span>
          </h5>
          <p id="currentTime"></p>
        </div>
      </div>
    </div>

    <div class="col-md-5">
      <div id="produkCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="magnifying-glass"></div>
        <div class="carousel-inner">
          @foreach($foto_barang as $index => $foto)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                {{-- <img class="d-block w-100" src="{{ asset($foto) }}"> --}}
                <img class="d-block w-100" src="http://admin.sibara.test{{ $foto }}" alt="Foto {{ $index + 1 }}">
            </div>
          @endforeach
        </div>
      </div>
      <div class="image-preview" id="thumbnailCarousel">
        @foreach ($foto_barang as $index => $foto)
          {{-- <img src="{{ asset($foto) }}" class="thumbnail" data-target="#produkCarousel" data-slide-to="{{ $index }}" alt="Thumbnail {{ $index + 1 }}"> --}}
          <img src="http://admin.sibara.test{{ $foto }}" class="thumbnail" data-bs-target="#produkCarousel" data-bs-slide-to="{{ $index }}" alt="Thumbnail {{ $index + 1 }}">
        @endforeach
      </div>
    </div>

    <div class="col-md-4">

      <h4>{{ $data_barang->nama_barang}}</h4>

      @if ($data_barang->harga_wajar->count() > 1)
        <div class="d-flex align-item-center">
          <p class="text-decoration-line-through text-secondary" style="margin-bottom: 0px;">
            Rp. {{ number_format($data_barang->harga_wajar->first()->harga, 0, ',', '.') }}</p>

            {{-- Menghitung persentase pengurangan --}}
              @php
                $persentase_pengurangan = (($data_barang->harga_wajar->first()->harga - $data_barang->harga_wajar->last()->harga) 
                / $data_barang->harga_wajar->first()->harga) * 100;
              @endphp
            {{-- ... --}}
            
            &nbsp;<span class="text-danger" style="margin-bottom: 0px; font-weight: bold;">
              {{ number_format($persentase_pengurangan) }}% </span>
        </div>
      @endif

      <h4><strong>Rp. {{ number_format($data_barang->harga_wajar->last()->harga, 0, ',', '.') }}</strong></h4>
      <hr>

      <h5>Deskripsi: </h5>
      <p>{{ $data_barang->deskripsi }}</p>

      <p>Kategori: {{ $data_barang->kategori->nama_kategori }}</p>
      
      @auth
        <a href="#"><button class="btn btn-success w-100"><i class="fa fa-plus"></i>&nbsp;Ajukan Tawaran</button></a>
      @else
        <form action="/account/login" method="get">
          <button class="btn btn-success w-100"><i class="fa fa-plus"></i> &nbsp;Ajukan Tawaran</button>
        </form>
      @endauth
      
    </div>
    
  </div>
</div>

@endsection