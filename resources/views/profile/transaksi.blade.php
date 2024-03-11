@extends('dashboard.layouts.main')


@section('content')


@if(session('success'))
  <div aria-live="polite" aria-atomic="true" class="position-relative bd-example-toasts rounded-3">
    <div class="toast-container top-0 end-0 p-0" id="toastPlacement">
      <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <strong class="me-auto">Sukses</strong>
          <small>1 detik yang lalu</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          {{ session('success') }}
        </div>
      </div>
    </div>
  </div>
@endif


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
            $notifCount = isset($notif['transaksi']) ? $notif['transaksi'] : null;
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
                @if ($notifCount)
                  @if($notifCount->isNotEmpty())
                    <span class="badge bg-success rounded-pill" style="position: absolute; top: 50%; transform: translateY(-50%); right: 10px;">
                    {{ $notifCount->count() }}</span>
                  @endif
                @endif
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="/pembayaran">Menunggu Pembayaran</a></li>
                <li><a class="dropdown-item active success" style="background-color: #0d8c46" href="/transaksi">Transaksi Anda</a></li>
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
            <h5 class="text-secondary">Daftar Transaksi</h5>
            <br>
              @if($transaksi->isNotEmpty())
                @foreach ($transaksi as $index => $pembelian)
                  <div class="card">
                    <div class="card-body" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                      <div class="row">
                        <div class="col-md-8">
                          <p class=""><strong>Pembayaran</strong> {{ \Carbon\Carbon::parse($pembelian->tanggal)->format('j M Y \j\a\m H:i') }}
                            @if($pembelian->status == 'review')
                              <span class="badge text-bg-secondary">Menunggu Konfirmasi</span>
                            @elseif ($pembelian->status == 'data_salah')
                              <span class="badge text-bg-danger">Transaksi Salah</span>
                            @else 
                              <span class="badge text-bg-success">Sukses</span>
                            @endif
                          </p>
                          <p>{{ $pembelian->penawaran->barang_rampasan->nama_barang }}</p>
                          
                        </div>
                        <div class="col-md-4">
                          @if ($pembelian->status == 'data_salah')
                            <p>Bayar sebelum: <strong class="countdownWinner text-danger"></strong></p>
                            <p class="batas" data-end-date="{{ $countdownWinner[$index] }}" data-index="{{ $index }}"></p>
                            <a href="/revisi/{{ $pembelian->penawaran->id }}"><button class="btn btn-success">Upload Ulang</button></a>
                          @elseif ($pembelian->status == 'verified')
                            <a href="/print-pdf/{{ $pembelian->id }}"><button class="btn btn-success mt-4"><i class="fa-solid fa-print"></i>&nbsp; Cetak Bukti Pembayaran</button></a>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <br>
                @endforeach
              @else
                <div class="card">
                  <div class="card-body" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <p>Belum ada transaksi</p>
                    <br>
                  </div>
                </div>
                <br><br>
              @endif
            <br><br><br>

            @if ($transaksi)
              {{ $transaksi->links('pagination::bootstrap-5') }}
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection