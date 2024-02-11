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
            <a href="/account/profile" class="text-decoration-none"><li class="list-group-item d-flex justify-content-between align-items-center">
              Informasi Pribadi
            </li></a>
            <a href="/account/penawaran" class="text-decoration-none"><li class="list-group-item d-flex justify-content-between align-items-center">
              Penawaran Anda
              @if ($penawaranAvailable)
                <span class="badge bg-success rounded-pill">{{ $penawaranAvailable->count() }}</span>
              @endif
            </li></a>
            <li class="list-group-item dropdown ">
              <a class="dropdown-toggle text-decoration-none text-success" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <strong>Transaksi</strong>
                <span class="badge bg-success rounded-pill">1</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="#">Menunggu Pembayaran</a></li>
                <li><a class="dropdown-item" href="#">Transaksi Anda</a></li>
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
            <h5><strong>Pembayaran Lelang</strong></h5>
            <p>Berikut adalah list pembayaran lelang yang anda menangkan</p>
            <table class="table table-striped table-bordered datatable">
              <thead>
                <tr>
                  <th style="vertical-align: middle;">No.</th>
                  <th style="vertical-align: middle;">Nama Barang</th>
                  <th style="vertical-align: middle;">Harga Penawaran</th>
                  <th style="vertical-align: middle;">Waktu Pembayaran</th>
                  <th style="vertical-align: middle;">Status</th>
                  <th style="vertical-align: middle;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($transaksi as $index => $payment)
                  <tr>
                    <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Bayar Sekarang</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection