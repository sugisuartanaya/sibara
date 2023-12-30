@extends('dashboard.layouts.main')


@section('content')

<div class="container py-4">
  <div class="row">
    <div class="col-md-4">
      <div class="outer-card">
        <div class="card background-card"></div>
        <div class="card mt-1">
          <div class="card-header">
            <strong>Informasi Pribadi</strong>
          </div>
          <div class="card-body">
            <p class="text-secondary mb-0" >Nama</p>          
            <h6 class="mb-3">{{ auth()->user()->pembeli->nama_pembeli }}</h6>
            <p class="text-secondary mb-0" >Pekerjaan</p>          
            <h6 class="mb-3">{{ auth()->user()->pembeli->pekerjaan }}</h6>
            <p class="text-secondary mb-0" >Alamat</p>          
            <h6 class="mb-3">{{ auth()->user()->pembeli->alamat }}</h6>
            <p class="text-secondary mb-0" >No Telepon</p>          
            <h6 class="mb-3">+62{{ auth()->user()->pembeli->no_telepon }}</h6>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
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
                      <th scope="col">No</th>
                      <th scope="col">Tgl Penawaran</th>
                      <th scope="col" class="w-50 text-break">Nama Barang</th>
                      <th scope="col">Penawaran</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($jumlahPenawaran)
                      @foreach ($jumlahPenawaran as $index => $penawaran)
                        <tr>
                          <th scope="row">{{ $index + 1 }}</th>
                          <td>{{ $penawaran->tanggal }}</td>
                          <td class="w-50 text-break">{{ $penawaran->barang_rampasan->nama_barang }}</td>
                          <td>Rp. {{ number_format($penawaran->harga_bid, 0, ',', '.') }}</td>
                          <td>-</td>
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
                    @if($history)
                      @foreach ($history as $index => $riwayat)
                        <tr>
                          <td>{{ $riwayat->tanggal }}</td>
                          <td class="w-50 text-break">{{ $riwayat->barang_rampasan->nama_barang }}</td>
                          <td>Rp. {{ number_format($riwayat->harga_bid, 0, ',', '.') }}</td>
                          <td>-</td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
                <div>
                  {{ $history->links('pagination::bootstrap-5') }}
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