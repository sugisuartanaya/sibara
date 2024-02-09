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
      @php
        $itemId = urlencode($data_barang->id);
        $itemName = urlencode($data_barang->nama_barang);
        $itemDescription = urlencode($data_barang->deskripsi);
        $itemImage = url("http://admin.sibara.test{$data_barang->foto_thumbnail}");
      @endphp
      <button class="btn btn-sm btn-primary mb-3" id="facebook-share-btn" 
        data-item-id="{{ $itemId }}" 
        data-item-name="{{ $itemName }}" 
        data-item-description="{{ $itemDescription }}" 
        data-item-image="{{ $itemImage }}">
        <i class="fa-brands fa-facebook"></i>&nbsp;Facebook
      </button>&nbsp;

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
              {{ $jadwal->start_date->format('j F Y \j\a\m H:i') }}  s/d </p>
            <p class="text-secondary mb-0" style="font-size: 11pt">
              {{ $jadwal->end_date->format('j F Y \j\a\m H:i') }} WITA</p>
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
                {{ $jadwal->start_date->format('j F Y \j\a\m H:i') }}  s/d </p>
              <p class="text-secondary mb-0" style="font-size: 11pt">
                {{ $jadwal->end_date->format('j F Y \j\a\m H:i') }} WITA</p>
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

@endsection