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
            $notifCount = isset($notif['transaksi']) ? $notif['transaksi'] : null;
          @endphp

          <ul class="list-group list-group-flush">
            <a href="/account/profile" class="text-decoration-none"><li class="list-group-item d-flex justify-content-between align-items-center">
              Informasi Pribadi
            </li></a>
            <a href="/account/penawaran" class="text-decoration-none"><li class="list-group-item d-flex justify-content-between align-items-center text-success">
              <strong>Penawaran Anda</strong>
              @if ($penawaranAvailable)
                <span class="badge bg-success rounded-pill" style="position: absolute; top: 50%; transform: translateY(-50%); right: 10px;">{{ $penawaranAvailable->count() }}</span>
              @endif
            </li></a>
            <li class="list-group-item dropdown" style="position: relative;">
              <a class="dropdown-toggle text-decoration-none text-dark" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Transaksi
                @if ($notifCount)
                  @if($notifCount->isNotEmpty())
                    <span class="badge bg-success rounded-pill" style="position: absolute; top: 50%; transform: translateY(-50%); right: 10px;">
                    {{ $notifCount->count() }}</span>
                  @endif
                @endif
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="/pembayaran">Menunggu Pembayaran</a></li>
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
            <h5><strong>Penawaran Lelang</strong></h5>

            <ul class="nav nav-underline" id="myTabs">
              <li class="nav-item navigasi">
                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#current">Terbaru</a>
              </li>
              <li class="nav-item navigasi">
                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#history">Riwayat</a>
              </li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane fade show active" id="current">
                <h4 class="py-2">Penawaran Terbaru Anda</h4>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Tgl Penawaran</th>
                      <th scope="col" class="w-50 text-break">Nama Barang</th>
                      <th scope="col">Penawaran</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($penawaranAvailable)
                      @foreach ($penawaranAvailable as $index => $penawaran)
                        <tr>
                          <td>{{ \Carbon\Carbon::parse($penawaran->created_at)->translatedFormat('j F Y \j\a\m H:i') }}</td>
                          <td class="w-50 text-break">{{ $penawaran->barang_rampasan->nama_barang }}</td>
                          <td>Rp. {{ number_format($penawaran->harga_bid, 0, ',', '.') }}</td>
                          @if($penawaran->status == 'menang')
                            <td><span class="badge text-bg-success">Menang</span></td>
                          @elseif($penawaran->status == 'pending')
                            <td><span class="badge text-bg-secondary">Pending</span></td>
                          @elseif($penawaran->status == 'kalah')
                            <td><span class="badge text-bg-warning">Kalah</span></td>
                          @elseif($penawaran->status == 'wanprestasi')
                            <td><span class="badge text-bg-danger">Wanprestasi</span></td>
                          @endif
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
                <div>
                  @if ($penawaranAvailable)
                    {{ $penawaranAvailable->links('pagination::bootstrap-5') }}
                  @endif
                </div>
              </div>

              <div class="tab-pane fade" id="history">
                <h4 class="py-2">Riwayat Penawaran Anda</h4>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Tgl Penawaran</th>
                      <th scope="col" class="w-50 text-break">Nama Barang</th>
                      <th scope="col">Penawaran</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($penawaranExpired)
                      @foreach ($penawaranExpired as $index => $riwayat)
                        <tr>
                          <td>{{ \Carbon\Carbon::parse($riwayat->created_at)->translatedFormat('j F Y \j\a\m H:i') }}</td>
                          <td class="w-50 text-break">{{ $riwayat->barang_rampasan->nama_barang }}</td>
                          <td>Rp. {{ number_format($riwayat->harga_bid, 0, ',', '.') }}</td>
                          @if($riwayat->status == 'menang')
                            <td><span class="badge text-bg-success">Menang</span></td>
                          @elseif($riwayat->status == 'pending')
                            <td><span class="badge text-bg-secondary">Pending</span></td>
                          @elseif($riwayat->status == 'kalah')
                            <td><span class="badge text-bg-warning">Kalah</span></td>
                          @elseif($riwayat->status == 'wanprestasi')
                            <td><span class="badge text-bg-danger">Wanprestasi</span></td>
                          @endif
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
                <div>
                  @if ($penawaranExpired)
                    {{ $penawaranExpired->links('pagination::bootstrap-5') }}
                  @endif
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection