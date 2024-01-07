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
          <ul class="list-group list-group-flush">
            <a href="/account/profile" class="text-decoration-none"><li class="list-group-item d-flex justify-content-between align-items-center">
              Informasi Pribadi
            </li></a>
            <a href="/account/penawaran" class="text-decoration-none"><li class="list-group-item d-flex justify-content-between align-items-center text-success">
              <strong>Penawaran Anda</strong>
              @if ($penawaranAvailable)
                <span class="badge bg-success rounded-pill">{{ $penawaranAvailable->count() }}</span>
              @endif
            </li></a>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Transaksi Penawaran
              <span class="badge bg-success rounded-pill">1</span>
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
                          <td>{{ $penawaran->tanggal }}</td>
                          <td class="w-50 text-break">{{ $penawaran->barang_rampasan->nama_barang }}</td>
                          <td>Rp. {{ number_format($penawaran->harga_bid, 0, ',', '.') }}</td>
                          <td><span class="badge text-bg-primary">{{ $penawaran->status }}</span></td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
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
                          <td>{{ $riwayat->tanggal }}</td>
                          <td class="w-50 text-break">{{ $riwayat->barang_rampasan->nama_barang }}</td>
                          <td>Rp. {{ number_format($riwayat->harga_bid, 0, ',', '.') }}</td>
                          @if($riwayat->status == 'menang')
                            <td><span class="badge text-bg-success">{{ $riwayat->status }}</span></td>
                          @elseif($riwayat->status == 'pending')
                            <td><span class="badge text-bg-primary">{{ $riwayat->status }}</span></td>
                          @elseif($riwayat->status == 'kalah')
                            <td><span class="badge text-bg-warning">{{ $riwayat->status }}</span></td>
                          @elseif($riwayat->status == 'wanprestasi')
                            <td><span class="badge text-bg-danger">{{ $riwayat->status }}</span></td>
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