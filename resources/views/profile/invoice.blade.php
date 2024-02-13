@extends('dashboard.layouts.main')


@section('content')

<div class="container py-4">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <h5>Pembayaran pada {{ $penawaran->barang_rampasan->nama_barang }}</h5>
          <p>Silahkan lakukan pembayaran ke nomor rekening kami dibawah ini. Pastikan nominal sudah sama persis dengan total pembayaran.</p>
          <br>
          <div class="col-md-5">
            <table class="table table-borderless">
              <tbody>
                <tr>
                  <td><strong>AN</strong></td>
                  <td><strong>I Gusti Ngurah Budiyasa</strong></td>
                </tr>
                <tr>
                  <td><strong>BRI</strong></td>
                  <td><strong>123456789</strong></td>
                </tr>
                <tr>
                  <td><strong>Total</strong></td>
                  <td><strong>Rp. {{ number_format($penawaran->harga_bid, 0, ',', '.') }}</strong></td>
                </tr>
              </tbody>
            </table>
          </div>
          <p>Untuk menghindari pembatalan pembayaran, mohon lakukan pembayaran dalam waktu 1 x 24 jam.</p>
          <p class="alert alert-warning"><strong>Jika sudah melakukan pembayaran, harap mengunggah bukti transfer pada kolom yang telah disediakan.</strong></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <form action=""></form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection