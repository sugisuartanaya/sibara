@extends('dashboard.layouts.main')


@section('content')

<div class="container py-4">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <h5>Pembayaran pada {{ $penawaran->barang_rampasan->nama_barang }}</h5>
          <p>Silahkan lakukan pembayaran ke nomor rekening kami dibawah ini. Pastikan nominal sudah sama persis dengan total pembayaran.</p>
          <div class="col-md-5">
            <table class="table table-borderless">
              <tbody>
                <tr>
                  <td><strong>AN</strong></td>
                  <td><strong>: RPL 037 KEJARI DENPASAR</strong></td>
                </tr>
                <tr>
                  <td><strong>BRI</strong></td>
                  <td><strong>: 001701002536305</strong></td>
                </tr>
                <tr>
                  <td><strong>Total</strong></td>
                  <td><strong>: Rp. {{ number_format($penawaran->harga_bid, 0, ',', '.') }}</strong></td>
                </tr>
              </tbody>
            </table>
          </div>
          <p>Untuk menghindari pembatalan pembayaran, mohon lakukan pembayaran sebelum waktu berakhir.</p>
          <p>Bayar sebelum: <strong id="countdownWinner" class="text-danger"></strong></p>
          <p id="batas" dataEndDate= {{ $countdownWinner }}></p>
          <p class="alert alert-warning"><strong>Jika sudah melakukan pembayaran, harap mengunggah bukti transfer pada kolom yang telah disediakan.</strong></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <p>Silahkan unggah bukti transfer</p>
          <form action="/pembayaran/{{ $penawaran->id }}" method="post" enctype="multipart/form-data">
            @csrf
            <input name="foto_bukti" type="file" id="image-selfie" accept="image/*" class="form-control" required>
            <input type="hidden" value={{ $penawaran->pembeli->id }} name="id_pembeli">
            <input type="hidden" value={{ $penawaran->id_jadwal }} name="id_jadwal">
            <input type="hidden" value={{ $penawaran->id }} name="id_penawaran">

            <img id="image-preview-selfie" class="image-preview" alt="Image Preview Selfie">
            <br>
            <button type="submit" class="btn btn-success d-block mx-auto">Unggah bukti transfer</button>
            <br>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection