@extends('dashboard.layouts.main')


@section('content')
<div class="container py-4">
  <div class="row">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-secondary">Beranda</a></li>
        <li class="breadcrumb-item" aria-current="page">Pengumuman</li>
      </ol>
    </nav>
    <div class="col-md-12 d-flex align-items-center">
      <h2 class="section-title2">Pengumuman Hasil Lelang</h2>
      <hr class="flex-grow-1 mx-2">
    </div>
  </div>

  <div class="row py-4">
    @if($jadwal)
      <h5>Telah dilaksanakan lelang penjualan langsung dengan rincian sebagai berikut:</h5>
      <p style="font-weight: bold; margin-bottom: 0px">No Surat Keterangan Penjualan Langsung: </p>
      <p class="mt-0 mb-2">{{ $jadwal->no_sprint }}</p>
      <p style="font-weight: bold; margin-bottom: 0px">Tanggal Surat Keterangan Penjualan Langsung: </p>
      <p class="mt-0 mb-2">{{ \Carbon\Carbon::parse($jadwal->tgl_sprint)->format('d F Y') }}</p>
      <p style="font-weight: bold; margin-bottom: 0px">Pelaksanaan Lelang Penjualan Langsung: </p>
      <p class="mt-0 mb-2">{{ \Carbon\Carbon::parse($jadwal->start_date)->format('d F Y') }} s/d {{ \Carbon\Carbon::parse($jadwal->end_date)->format('d F Y') }}, jam {{ \Carbon\Carbon::parse($jadwal->start_date)->format('H.i') }} - {{ \Carbon\Carbon::parse($jadwal->end_date)->format('H.i') }} WITA</p>

      <div class="col-md-12 mt-3">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <td>No.</td>
              <td>Nama Barang Lelang</td>
              <td>Nama Pemenang</td>
              <td>Harga Penawaran</td>
              <td>Tanggal Penawaran</td>
            </tr>
          </thead>
          <tbody>
            @if($daftar_barang)
              @foreach($daftar_barang as $index => $barang)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $barang->nama_barang }}</td>
                  @if(isset($penawarTertinggi[$barang->id]))
                    <td>{{ $penawarTertinggi[$barang->id]->pembeli->nama_pembeli }}</td>
                    <td>Rp. {{ number_format($penawarTertinggi[$barang->id]->harga_bid, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($penawarTertinggi[$barang->id]->tanggal)->format('d M Y, \J\a\m H:i') }}</td>
                  @else
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                  @endif
              </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    
    @else
      <h5>Saat ini belum ada Jadawal Penjualan Langsung Barang Rampasan Negara</h5>
      <p>Nantikan jadwal selanjutnya</p>
    @endif
    
  </div>

</div>


@endsection