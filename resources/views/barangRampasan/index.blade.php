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
          <form action="/filter" id="filter" method="GET">
            @csrf
            <input type="hidden" name="search" value="{{ isset($request) ? $request->input('search') : '' }}">
            @foreach($daftar_kategori as $kategori)
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="kategori[]" value="{{ $kategori->id }}" id="{{ $kategori->id }}" 
                @if(in_array($kategori->id, request('kategori', []))) checked @endif>
                <label class="form-check-label" for="{{ $kategori->id }}">
                  {{ $kategori->nama_kategori }}
                </label>
              </div>
            @endforeach
            <div class="text-center mt-3">
              <button class="btn btn-sm btn-success" style="width: 100%;"><i class="fa fa-filter"></i>&nbsp;Terapkan</button>
            </div>
        </div>
      </div>

      <div class="card mt-3">
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
    <div class="col-md-9">
      <div class="row align-items-center">
        <div class="col-auto">
          <label for="inputPassword6" class="col-form-label">Urutkan: </label>
        </div>
        <div class="col-auto" id="select-urutan">
          <select name="urutan" class="form-select form-select-sm" aria-label="Small select example">
            <option @if(request('urutan') == '') selected @endif>Pilih urutan</option>
            <option value="terbaru" @if(request('urutan') == 'terbaru') selected @endif>Terbaru</option>
            <option value="termurah" @if(request('urutan') == 'termurah') selected @endif>Harga Limit (Termurah - Termahal)</option>
            <option value="termahal" @if(request('urutan') == 'termahal') selected @endif>Harga Limit (Termahal - Termurah)</option>
          </select>
        </div>
      </div>
      </form>
      <hr>
      <div class="row py-2">
        
        @if ($daftar_barang->isNotEmpty())
          @if(isset($request) ? $request->input('search') : '')
            <div class="col-md-12">
              <div class="alert alert-success" role="alert">
                Hasil pencarian dengan kata kunci <strong>{{ $request->input('search') }}</strong>
              </div>
            </div>
          @endif
          @foreach ($daftar_barang as $daftar)
            <div class="col-md-3 mb-4">
              <div class="card position-relative">
                {{-- <img class="bd-placeholder-img card-img-top" src="asset{{ $daftar->foto_thumbnail }}" style="object-fit: cover; width: 100%; height: 300px;"  alt="Your Alt Text"> --}}
                <img class="bd-placeholder-img card-img-top" src="http://admin.sibara.test{{ $daftar->foto_thumbnail }}" style="object-fit: cover; width: 100%; height: 300px;"  alt="Your Alt Text">

                <div class="card-body" style="background-color: #F4F4F2;">
                  <div class="card-text">
                    <h6 class="text-left">{{ \Illuminate\Support\Str::limit($daftar->nama_barang, 50, '...') }}</h6>
                    <p class="text-secondary">{{ $daftar->kategori->nama_kategori }}</p>
                    <p>Daftar Barang:</p>
                    @foreach($daftar->daftar_barang as $daftarBarang)
                        <p>ID Daftar Barang: {{ $daftarBarang->id }}</p>
                        {{-- Display other Daftar_barang fields as needed --}}
                    @endforeach
                    @if ($daftar->harga_wajar->count()>1)
                      <div class="d-flex align-item-center">
                        <p class="text-decoration-line-through text-secondary" style="margin-bottom: 0px">
                          Rp. {{ number_format($daftar->harga_wajar->first()->harga, 0, ',', '.') }}</p>
  
                          {{-- Menghitung persentase pengurangan --}}
                            @if ($daftar->harga_wajar->first()->harga && $daftar->harga)
                              @php
                                $persentase_pengurangan = (($daftar->harga_wajar->first()->harga - $daftar->harga) / $daftar->harga_wajar->first()->harga) * 100;
                              @endphp
                            @endif
                          {{-- ... --}}
                          
                          &nbsp;<span class="text-danger" style="font-weight: bold;">{{ number_format($persentase_pengurangan) }}% </span>
                      </div>
                    @else
                      <div class="mb-2" style="height: 17px; flex-shrink: 0;"></div>
                    @endif
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
            {{ isset($request) ? $daftar_barang->appends([
              'urutan' => $request->urutan, 
              'kategori' => session('selected_kategori', []),
              'search' => $request->input('search')])->links('pagination::bootstrap-5') : $daftar_barang->links('pagination::bootstrap-5') }}
          </div>

        @else
          <div class="col-md-12">
            <div class="alert alert-danger text-center" role="alert">
              <h5>Maaf, tidak ditemukan data barang rampasan dengan kriteria yang Anda inginkan.</h5>
            </div>
          </div>
        @endif
      </div>
      
    </div>
    
  </div>
    
</div>

@endsection