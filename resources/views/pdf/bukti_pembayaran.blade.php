<!doctype html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIBARA | Informasi Barang Rampasan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
      .watermark {
        position: fixed; /* Tetapkan posisi ke tengah */
        top: 32%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: -1; /* Letakkan di belakang konten utama */
        opacity: 0.2; /* Atur opacity (kejernihan) teks */
        font-size: 120px; /* Atur ukuran teks */
        color: green; /* Atur warna teks */
        font-family: Arial, sans-serif; /* Atur jenis font */
        font-weight: bold; /* Atur ketebalan font */
        padding: 10px; /* Atur padding untuk membuat border */
        border: 2px solid green; /* Atur border */
      }

      .container {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
      }
    
      .logo {
        width: 70px; /* Atur ukuran logo sesuai kebutuhan */
        height: auto; /* Atur ketinggian agar logo tidak terdistorsi */
      }
    
      .text-container {
        margin-left: 20px; /* Atur jarak antara logo dan teks */
      }

      hr {
        width: 100%; /* Atur lebar garis horizontal agar memenuhi lebar container */
        margin: 5px 0; /* Atur jarak atas dan bawah dari hr */
        border: none; /* Hapus border */
        border-top: 3px solid black; /* Tambahkan border atas dengan warna hitam */
      }

      table {
        border-collapse: collapse;
        width: 100%;
      }
      
      th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
      }
    
      @media print {
        /* Atur tata letak untuk saat dicetak */
        .container {
          flex-direction: column;
        }
    
        .text-container {
          margin-top: 10px; /* Atur jarak antara logo dan teks saat dicetak */
          margin-left: 0; /* Setel margin kembali ke 0 */
        }
      }
    </style>
  </head>
  <body>
      <div class="watermark">
        LUNAS
      </div>

      <div class="container">
        <a href="/"><img src="{{ asset('images/logo2.png') }}" alt="logo" class="logo"></a>
        <div class="text-container">
          <h5 style="font-weight: normal; margin-bottom: 1px">Kejaksaan Republik Indonesia</h5>
          <h3 style="margin-bottom: 1px"><strong>Kejaksaan Negeri Denpasar</strong></h3>
          <p style="margin-bottom: 1px; font-size: 10pt;">Jl. PB. Sudirman No. 3, Denpasar Telp. (0361)221999</p>
          <p style="margin-bottom: 1px; font-size: 10pt;">www.kejari-denpasar.go.id</p>
        </div>
      </div>
      <hr style="border-top: 3px solid black;">
      <br>
      <h3 class="mt-0 text-center"><strong>BUKTI PEMBAYARAN LELANG</strong></h4>
      <br><br>
      
      <p>Pembayaran anda sudah terkonfirmasi dengan detail barang lelang sebagai berikut:</p>
      <br>
      <table>
        <tr>
          <td>No. Putusan Pengadilan</td>
          <td>{{ $transaksi->penawaran->barang_rampasan->no_putusan }}</td>
        </tr>
        <tr>
          <td>Nama Barang Lelang</td>
          <td>{{ $transaksi->penawaran->barang_rampasan->nama_barang }}</td>
        </tr>
        <tr>
          <td>Nama Pembeli</td>
          <td>{{ $transaksi->pembeli->nama_pembeli }}</td>
        </tr>
        <tr>
          <td>Tanggal Transaksi</td>
          <td>{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d F Y') }}</td>
        </tr>
        <tr>
          <td>Harga Penawaran</td>
          <td>Rp. {{ number_format($transaksi->penawaran->harga_bid, 0, ',', '.') }}</td>
        </tr>
      </table>
      <h4></h4>
      <br>
      <p>Silahkan tunjukkan bukti pembayaran ini serta Kartu Tanda Penduduk (KTP) anda kepada petugas barang bukti ketika mengambil barang lelang di Kantor Kejaksaan Negeri Denpasar.</p>
      <p>Waktu pengambilan barang lelang: <strong>Senin-Jumat pukul 09.00 - 16.00 Wita</strong></p>
      
  </body>
    
</html>