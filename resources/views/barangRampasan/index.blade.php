@extends('dashboard.layouts.main')


@section('content')

<div class="container py-4">
  <div class="row">
    <div class="col-md-12 d-flex align-items-center">
      <h2 class="section-title2">Barang Rampasan Negara</h2>
      <hr class="flex-grow-1 mx-2">
    </div>
  </div>

  <div class="row py-4">
    <div class="col-md-3">
      <div class="card">
        <div class="card-header">
          <h6><strong class="text-uppercase">kategori</strong></h6>
        </div>
        <div class="card-body">
          <form action="">
            @foreach($daftar_kategori as $kategori)
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="{{ $kategori->id }}" id="{{ $kategori->id }}">
                <label class="form-check-label" for="{{ $kategori->id }}">
                  {{ $kategori->nama_kategori }}
                </label>
              </div>
            @endforeach
            <div class="text-center mt-3">
              <button class="btn btn-sm btn-success" style="width: 100%;"><i class="fa fa-filter"></i>&nbsp;Terapkan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div id="filter-urutan">
        <form action="/filter-urutan">
          @csrf
          <div class="row g-3 align-items-center">
            <div class="col-auto">
              <label for="inputPassword6" class="col-form-label">Urutkan: </label>
            </div>
            <div class="col-auto">
              <select name="urutan" class="form-select form-select-sm" aria-label="Small select example">
                <option @if(request('urutan') == '') selected @endif>Pilih urutan</option>
                <option value="terbaru" @if(request('urutan') == 'terbaru') selected @endif>Terbaru</option>
                <option value="termurah" @if(request('urutan') == 'termurah') selected @endif>Harga Limit (Termurah - Termahal)</option>
                <option value="termahal" @if(request('urutan') == 'termahal') selected @endif>Harga Limit (Termahal - Termurah)</option>
              </select>
            </div>
          </div>
        </form>
      </div>
      
      <hr>
      <div class="row py-2">
        @if ($daftar_barang->isNotEmpty())
          @foreach ($daftar_barang as $daftar)
          {{-- dapatkan harga terakhir --}}
          {{-- @php
            $latestHarga = $harga_terakhir[$daftar->id_barang];
          @endphp --}}
          <div class="col-md-3 mb-4">
            <div class="card position-relative">
              {{-- <img class="bd-placeholder-img card-img-top" src="asset{{ $daftar->foto_thumbnail }}" style="object-fit: cover; width: 100%; height: 300px;"  alt="Your Alt Text"> --}}
              <img class="bd-placeholder-img card-img-top" src="http://admin.sibara.test{{ $daftar->foto_thumbnail }}" style="object-fit: cover; width: 100%; height: 300px;"  alt="Your Alt Text">

              <div class="card-body" style="background-color: #F4F4F2;">
                <div class="card-text">
                  <h6 class="text-left">{{ \Illuminate\Support\Str::limit($daftar->nama_barang, 50, '...') }}</h6>
                  <p class="text-secondary">{{ $daftar->kategori->nama_kategori }}</p>
                  <div class="d-flex justify-content-between align-items-start">
                    <h5 class=""><strong>Rp. {{ number_format($daftar->harga, 0, ',', '.') }}</strong></h5>
                    <p class="text-secondary">0 <i class="fa fa-user"></i></p>
                  </div>
                  <div class="text-center">
                    <button class="btn btn-sm btn-outline-success">Detail Barang</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach

          <div>
            {{ isset($request) ? $daftar_barang->appends(['urutan' => $request->urutan])->links('pagination::bootstrap-5') : $daftar_barang->links('pagination::bootstrap-5') }}

          </div>

        @else
          <h5 class="text-center">
            Saat ini belum ada Barang Rampasan Negara Terdaftar
          </h5>
        @endif
      </div>
      
    </div>
    
  </div>
    
</div>

@endsection