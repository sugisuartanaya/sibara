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
            <h5><strong>Pembelian</strong></h5>

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
                <h4 class="py-2">Pembelian Terbaru Anda</h4>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Tgl Lelang</th>
                      <th scope="col">Nama Barang</th>
                      <th scope="col">Harga Tertinggi</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>23-12-2023</td>
                      <td>Satu unit Spm Honda Beat DK 3467 ABL, STNKnya</td>
                      <td>Rp. 1.000.000</td>
                      <td>@mdo</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>23-12-2023</td>
                      <td>1 (satu) spm Honda Scoopy No.Pol DK 2285 FBY</td>
                      <td>Rp. 1.000.000</td>
                      <td>@fat</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>23-12-2023</td>
                      <td>1 (satu) buah HP Android Oppo warna hitam</td>
                      <td>Rp. 1.000.000</td>
                      <td>@twitter</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="tab-pane fade" id="history">
                <h4 class="py-2">Riwayat Pembelian Anda</h4>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Tgl Lelang</th>
                      <th scope="col">Nama Barang</th>
                      <th scope="col">Harga Pengajuan Tertinggi</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>23-12-2023</td>
                      <td>Satu unit Spm Honda Beat DK 3467 ABL, STNKnya</td>
                      <td>Rp. 1.000.000</td>
                      <td>@mdo</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>23-12-2023</td>
                      <td>1 (satu) spm Honda Scoopy No.Pol DK 2285 FBY</td>
                      <td>Rp. 1.000.000</td>
                      <td>@fat</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>23-12-2023</td>
                      <td>1 (satu) buah HP Android Oppo warna hitam</td>
                      <td>Rp. 1.000.000</td>
                      <td>@twitter</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection