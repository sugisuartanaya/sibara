@extends('dashboard.layouts.main')


@section('content')

<div class="container py-4">
  <div class="row">
    <div class="col-md-3">
      <div class="outer-card">
        <div class="card background-card"></div>
        <div class="card mt-1">
          <div class="card-header">
            <strong>My Profile</strong>
          </div>
          
          
          @php
            $penawaranAvailable = isset($statusPenawaran['penawaranAvailable']) ? $statusPenawaran['penawaranAvailable'] : null;
          @endphp


          <ul class="list-group list-group-flush">
            <a href="/account/profile" class="text-decoration-none">
              <li class="list-group-item" style="position: relative;">
                Informasi Pribadi
              </li>
            </a>
            <a href="/account/penawaran" class="text-decoration-none">
              <li class="list-group-item" style="position: relative;">
                Penawaran Anda
                @if ($penawaranAvailable)
                  <span class="badge bg-success rounded-pill" style="position: absolute; top: 50%; transform: translateY(-50%); right: 10px;">{{ $penawaranAvailable->count() }}</span>
                @endif
              </li>
            </a>
            <li class="list-group-item dropdown" style="position: relative;">
              <a class="dropdown-toggle text-decoration-none text-success" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <strong>Transaksi</strong>
                <span class="badge bg-success rounded-pill" style="position: absolute; top: 50%; transform: translateY(-50%); right: 10px;">1</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item active success" style="background-color: #0d8c46" href="/pembayaran">Menunggu Pembayaran</a></li>
                <li><a class="dropdown-item" href="/transaksi">Transaksi Anda</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>

    </div>
    <div class="col-md-9">
      <div class="outer-card">
        <div class="card background-card"></div>
        <div class="card mt-1">
          <div class="card-body">
            <h5 class="text-secondary">Menunggu Pembayaran</h5>
            <br>
            <div class="card">
              <div class="card-body" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                {{-- @if($payment->isEmpty())
                  <p>Belum ada pembayaran</p>
                  <br><br><br>
                @else
                  
                @endif --}}
                @if ($expired == true)
                  <p>Belum ada pembayaran</p>
                  <br><br><br>
                @else
                  @foreach ($payment as $index => $pay)
                    <div class="row">
                      <div class="col-md-8">
                        <p class="mb-1"><strong>Nama Barang: </strong></p>
                        <p>{{ $pay->barang_rampasan->nama_barang }}</p>
                        
                        <p class="mb-1"><strong>Total Pembayaran: </strong></p>
                        <p>Rp. {{ number_format($pay->harga_bid, 0, ',', '.') }}</p>
                      </div>
                      <div class="col-md-4">
                        <p>Bayar sebelum: <strong id="countdownWinner" class="text-danger"></strong></p>
                        <p id="batas" dataEndDate= {{ $countdownWinner }}></p>
                        <a href="/invoice/{{ $pay->id }}"><button class="btn btn-success">Bayar Sekarang</button></a>
                      </div>
                    </div>
                  @endforeach
                @endif
                
              </div>
            </div>
            <br><br><br>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection