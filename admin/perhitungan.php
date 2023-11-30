<?php
session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['status'])) {
  header("Location: ../xml_get_current_byte_index(parser).php?pesan=logindahulu");
  exit;
}
require '../functions.php';




// JIKA TIDAK MENERIMA DATA ID ALTERNATIF MAKA LEMPAR KEMBALI KE data_pegawai.php
if (!isset($_POST['id_alternatif'])) {
  echo "<script>
  alert('Pilih Data Pegawai Terlebih Dahulu ! ')
  document.location.href='data_pegawai.php'
  </script>";
} else {

  //JIKA MENERIMA DATA ID ALTERNATIF MAKA JALANKAN HALAMAN perhitungan.php

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD MEREK
  $dataKriteriaPK = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'Pengalaman kerja'");
  $pengalamanKerja = mysqli_fetch_assoc($dataKriteriaPK);

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD BAHAN
  $dataKriteriaTJ = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'Tanggung Jawab'");
  $tanggungJawab = mysqli_fetch_assoc($dataKriteriaTJ);

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD BERAT
  $dataKriteriaKom = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'Komunikasi'");
  $komunikasi = mysqli_fetch_assoc($dataKriteriaKom);

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD HARGA
  $dataKriteriaWws = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'Wawasan'");
  $wawasan = mysqli_fetch_assoc($dataKriteriaWws);

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD HARGA
  $dataKriteriaPnp = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'Penampilan'");
  $penampilan = mysqli_fetch_assoc($dataKriteriaPnp);

  //MEMBUAT KODE OTOMATIS

  //MENGAMBIL DATA BARANG DENGAN KODE PALING BESAR
  $a = mysqli_query($con, "SELECT max(kode) AS kodeterbesar from hasil_akhir");
  $b = mysqli_fetch_array($a);
  $kodebarang = $b['kodeterbesar'];

  //MENGAMBIL ANGKA DARI KODE BARANG TERBESAR MENGGUNAKAN FUNSI substr
  //DAN DIUBAH KE INTEGER (int)

  $urutan = (int) substr($kodebarang, 3, 3);

  //BILANGAN YANG DIAMBIL INI DI TAMBAH 1 UNTUK MENENTUKAN NOMOR URUT BERIKUTNYA
  $urutan++;

  //MEMBENTUK KODE BARU
  //PERINTAH printf("%03s",$urutan); BERGUNA UNTUK MEMBUAT STRING MENJADI 3 KARAKTER
  //MISAL printf("%03s",15); MAKAMENGHASILKAN '015'
  $kodebarang = "k" . sprintf("%03s", $urutan);

  //JIKA TOMBOL SIMPAN DITEKAN MAKA
  if (isset($_POST['simpan'])) {
    if (insert_hasil_perankingan($_POST) > 0) {
      echo "<script>
          alert('data tersimpan')
          document.location.href='laporan.php'
          </script>";
    }
  }


?>
  <!doctype html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <style>
      body {
        background-color: #f0f0f0;
      }


      .container {
        min-height: calc(100vh - 211px - -60px);
      }

      .col-md-12 {
        padding: 8px;
      }

      .copyright {
      text-align: center;
      color: whitesmoke;
    }

      a font {
        color: whitesmoke;
      }

      .custom-bg {
            background-color: #f08080; /* Ganti dengan warna yang Anda inginkan */
        }
    .alert.alert-info {
      background-color: #FFDFDF; /* Ubah latar belakang title menjadi pink */
    }

    .custom-table-header tr {
        background-color:  #f08080; /* Warna pink */
    }

      .navbar-nav a:hover {
        font-weight: bold;
        color: darkblue;
      }

      tr:hover {
        -webkit-transform: scale(1.03);
        transform: scale(1.03);
        font-weight: bold;
      }
    </style>

    <title>PERHITUNGAN</title>
  </head>

  <body bgcolor="f0f0f0">
    <form method="post" action="perhitungan.php">
      <nav class="navbar navbar-expand-lg navbar-dark custom-bg">
        <a class="navbar-brand" href="#"><img src="../image/emina/logo.png" width="50"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav" style="margin: 10px;">
            <a class="nav-link active" href="index.php">
              <font size="4"><b>Home</b> </font><span class="sr-only">(current)</span>
            </a>
            <a class="nav-link" href="data_kriteria.php">
              <font size="4"><b>Data Kriteria</b></font>
            </a>
            <a class="nav-link" href="data_pegawai.php">
              <font size="4"><b>Data Calon Kepala Direktur</b></font>
            </a>
            <a class="nav-link" href="#">
              <font size="4"><b>Perhitungan</b></font>
            </a>
            <a class="nav-link" href="laporan.php">
              <font size="4"><b>Laporan</b></font>
            </a>
          </div>

          <div class="navbar-nav ms-auto" style="margin: 10px;">
            <a class="log nav-link m-auto" href="../logout.php">
              <font size="4"><b>Logout</b></font>
              <img src="../img/logout.png" width="30">
            </a>
          </div>
        </div>
      </nav>
    </form>

    <br>
    <div class="container bg-light shadow p-3 mb-5">

      <div class="alert alert-info">
        <center><b>DATA CALON DIREKTUR TERPILIH</b></center>
      </div>

      <div class="table-responsive p-4">
        <table class="table table-striped shadow">
         <thead class="custom-table-header">
          <tr>
            <th width="150">Id Alternatif</th>
            <th>Nama Pegawai</th>
            <th>Pengalaman Kerja (K1)</th>
            <th>Tanggung Jawab (K2)</th>
            <th>Komunikasi (K3)</th>
            <th>Wawasan (K4)</th>
            <th>Penampilan (K5)</th>
          </tr>
          </thead>

          <?php
          $id_alternatifs = $_POST['id_alternatif'];

          foreach ($id_alternatifs as $id_alternatif) {
              $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
              while ($pegawai = mysqli_fetch_assoc($data)) {
                  // Konversi nilai k1
                  if ($pegawai['k1'] < 2) {
                      $nilai_k1 = 4;
                  } elseif ($pegawai['k1'] >= 2 && $pegawai['k1'] <= 2.6) {
                      $nilai_k1 = 3;
                  } elseif ($pegawai['k1'] >= 2.7 && $pegawai['k1'] <= 2.9) {
                      $nilai_k1 = 2;
                  } else {
                      $nilai_k1 = 1;
                  }

                  // Konversi nilai k2
                  if ($pegawai['k2'] < 75) {
                      $nilai_k2 = 1;
                  } elseif ($pegawai['k2'] >= 76 && $pegawai['k2'] <= 80) {
                      $nilai_k2 = 2;
                  } elseif ($pegawai['k2'] >= 81 && $pegawai['k2'] <= 88) {
                      $nilai_k2 = 3;
                  } else {
                      $nilai_k2 = 4;
                  }

                  // Konversi nilai k3
                  if ($pegawai['k3'] < 75) {
                      $nilai_k3 = 1;
                  } elseif ($pegawai['k3'] >= 76 && $pegawai['k3'] <= 80) {
                      $nilai_k3 = 2;
                  } elseif ($pegawai['k3'] >= 81 && $pegawai['k3'] <= 88) {
                      $nilai_k3 = 3;
                  } else {
                      $nilai_k3 = 4;
                  }

                  
                  // Konversi nilai k4
                  if ($pegawai['k4'] < 75) {
                      $nilai_k4 = 1;
                  } elseif ($pegawai['k4'] >= 76 && $pegawai['k4'] <= 80) {
                      $nilai_k4 = 2;
                  } elseif ($pegawai['k4'] >= 81 && $pegawai['k4'] <= 88) {
                      $nilai_k4 = 3;
                  } else {
                      $nilai_k4 = 4;
                  }

                  
                  // Konversi nilai k5
                  if ($pegawai['k5'] < 75) {
                      $nilai_k5 = 1;
                  } elseif ($pegawai['k5'] >= 76 && $pegawai['k5'] <= 80) {
                      $nilai_k5 = 2;
                  } elseif ($pegawai['k5'] >= 81 && $pegawai['k5'] <= 88) {
                      $nilai_k5 = 3;
                  } else {
                      $nilai_k5 = 4;
                  }
                  // Tampilkan hasil dalam tabel
          ?>
                  <tr>
                      <td><?= $pegawai['id_alternatif']; ?></td>
                      <td><?= $pegawai['nama_pegawai']; ?></td>
                      <td><?= $nilai_k1; ?></td>
                      <td><?= $nilai_k2; ?></td>
                      <td><?= $nilai_k3; ?></td>
                      <td><?= $nilai_k4; ?></td>
                      <td><?= $nilai_k5; ?></td>
                  </tr>
          <?php
              }
          }
          ?>
          </form>
        </table>
      </div>


      <br><br>
      <hr>
      <br><br>

      <div class="alert alert-info">
        <center><b>NORMALISASI</b></center>
      </div>

      <div class="table-responsive p-4">
        <table class="table table-striped shadow">
         <thead class="custom-table-header">
          <tr>
          <th width="150">Id Alternatif</th>
            <th>Nama Pegawai</th>
            <th>Pengalaman Kerja (K1)</th>
            <th>Tanggung Jawab (K2)</th>
            <th>Komunikasi (K3)</th>
            <th>Wawasan (K4)</th>
            <th>Penampilan (K5)</th>
          </tr>
        </thead>

          <?php
          $pembagi1 = 0;
          $pembagi2 = 0;
          $pembagi3 = 0;
          $pembagi4 = 0;
          $pembagi5 = 0;


          $id_alternatifs = $_POST['id_alternatif'];

          foreach ($id_alternatifs as $id_alternatif) {
              $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
              while ($pegawai = mysqli_fetch_assoc($data)) {
                  // Konversi nilai k1
                  if ($pegawai['k1'] < 2) {
                      $nilai_k1 = 4;
                  } elseif ($pegawai['k1'] >= 2 && $pegawai['k1'] <= 2.6) {
                      $nilai_k1 = 3;
                  } elseif ($pegawai['k1'] >= 2.7 && $pegawai['k1'] <= 2.9) {
                      $nilai_k1 = 2;
                  } else {
                      $nilai_k1 = 1;
                  }

                  // Konversi nilai k2
                  if ($pegawai['k2'] < 75) {
                      $nilai_k2 = 1;
                  } elseif ($pegawai['k2'] >= 76 && $pegawai['k2'] <= 80) {
                      $nilai_k2 = 2;
                  } elseif ($pegawai['k2'] >= 81 && $pegawai['k2'] <= 88) {
                      $nilai_k2 = 3;
                  } else {
                      $nilai_k2 = 4;
                  }

                  // Konversi nilai k3
                  if ($pegawai['k3'] < 75) {
                      $nilai_k3 = 1;
                  } elseif ($pegawai['k3'] >= 76 && $pegawai['k3'] <= 80) {
                      $nilai_k3 = 2;
                  } elseif ($pegawai['k3'] >= 81 && $pegawai['k3'] <= 88) {
                      $nilai_k3 = 3;
                  } else {
                      $nilai_k3 = 4;
                  }

                  
                  // Konversi nilai k4
                  if ($pegawai['k4'] < 75) {
                      $nilai_k4 = 1;
                  } elseif ($pegawai['k4'] >= 76 && $pegawai['k4'] <= 80) {
                      $nilai_k4 = 2;
                  } elseif ($pegawai['k4'] >= 81 && $pegawai['k4'] <= 88) {
                      $nilai_k4 = 3;
                  } else {
                      $nilai_k4 = 4;
                  }

                  
                  // Konversi nilai k5
                  if ($pegawai['k5'] < 75) {
                      $nilai_k5 = 1;
                  } elseif ($pegawai['k5'] >= 76 && $pegawai['k5'] <= 80) {
                      $nilai_k5 = 2;
                  } elseif ($pegawai['k5'] >= 81 && $pegawai['k5'] <= 88) {
                      $nilai_k5 = 3;
                  } else {
                      $nilai_k5 = 4;
                  }
                  // Tampilkan hasil dalam tabel
                  $pembagi1 += pow($nilai_k1, 2);
                  $akar1 = sqrt($pembagi1);

                  $pembagi2 += pow($nilai_k2, 2);
                  $akar2 = sqrt($pembagi2);

                  $pembagi3 += pow($nilai_k3, 2);
                  $akar3 = sqrt($pembagi3);

                  $pembagi4 += pow($nilai_k4, 2);
                  $akar4 = sqrt($pembagi4);

                  $pembagi5 += pow($nilai_k5, 2);
                  $akar5 = sqrt($pembagi5);
          ?>
                  
          <?php
              }
          }
          ?>

          <?php
          $id_alternatifs = $_POST['id_alternatif'];
          foreach ($id_alternatifs as $id_alternatif) {
            $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
            while ($pegawai = mysqli_fetch_assoc($data)) {
              // Konversi nilai k1
                  if ($pegawai['k1'] < 2) {
                      $nilai_k1 = 4;
                  } elseif ($pegawai['k1'] >= 2 && $pegawai['k1'] <= 2.6) {
                      $nilai_k1 = 3;
                  } elseif ($pegawai['k1'] >= 2.7 && $pegawai['k1'] <= 2.9) {
                      $nilai_k1 = 2;
                  } else {
                      $nilai_k1 = 1;
                  }

                  // Konversi nilai k2
                  if ($pegawai['k2'] < 75) {
                      $nilai_k2 = 1;
                  } elseif ($pegawai['k2'] >= 76 && $pegawai['k2'] <= 80) {
                      $nilai_k2 = 2;
                  } elseif ($pegawai['k2'] >= 81 && $pegawai['k2'] <= 88) {
                      $nilai_k2 = 3;
                  } else {
                      $nilai_k2 = 4;
                  }

                  // Konversi nilai k3
                  if ($pegawai['k3'] < 75) {
                      $nilai_k3 = 1;
                  } elseif ($pegawai['k3'] >= 76 && $pegawai['k3'] <= 80) {
                      $nilai_k3 = 2;
                  } elseif ($pegawai['k3'] >= 81 && $pegawai['k3'] <= 88) {
                      $nilai_k3 = 3;
                  } else {
                      $nilai_k3 = 4;
                  }

                  
                  // Konversi nilai k4
                  if ($pegawai['k4'] < 75) {
                      $nilai_k4 = 1;
                  } elseif ($pegawai['k4'] >= 76 && $pegawai['k4'] <= 80) {
                      $nilai_k4 = 2;
                  } elseif ($pegawai['k4'] >= 81 && $pegawai['k4'] <= 88) {
                      $nilai_k4 = 3;
                  } else {
                      $nilai_k4 = 4;
                  }

                  
                  // Konversi nilai k5
                  if ($pegawai['k5'] < 75) {
                      $nilai_k5 = 1;
                  } elseif ($pegawai['k5'] >= 76 && $pegawai['k5'] <= 80) {
                      $nilai_k5 = 2;
                  } elseif ($pegawai['k5'] >= 81 && $pegawai['k5'] <= 88) {
                      $nilai_k5 = 3;
                  } else {
                      $nilai_k5 = 4;
                  }
          ?>


              <tr>
                <td><?= $pegawai['id_alternatif']; ?></td>
                <td><?= $pegawai['nama_pegawai']; ?></td>
                <!-- -----------K1----------- -->
                <td>
                  <?php $k1 = $nilai_k1 / $akar1;
                  echo round($k1, 5); ?>
                </td>
                <!-- -----------K2----------- -->
                <td>
                  <?php $k2 = $nilai_k2 / $akar2;
                  echo round($k2, 5); ?>
                </td>
                <!-- -----------K3----------- -->
                <td>
                  <?php $k3 = $nilai_k3 / $akar3;
                  echo round($k3, 5); ?>
                </td>
                <!-- -----------K4----------- -->
                <td><?php $k4 = $nilai_k4 / $akar4;
                    echo round($k4, 5); ?>
                </td>
                <!-- -----------K5----------- -->
                <td><?php $k5 = $nilai_k5 / $akar5;
                    echo round($k5, 5); ?>
                </td>
              </tr>


          <?php

            }
          }
          ?>
        </table>
      </div>


      <br><br>
     <hr>
      <br><br>

      <div class="alert alert-info">
        <center><b>TERBOBOT</b></center>
      </div>

      <div class="table-responsive p-4">
        <table class="table table-striped shadow">
        <thead class="custom-table-header">
          <tr">
          <th width="150">Id Alternatif</th>
            <th>Nama Pegawai</th>
            <th>Pengalaman Kerja (K1)</th>
            <th>Tanggung Jawab (K2)</th>
            <th>Komunikasi (K3)</th>
            <th>Wawasan (K4)</th>
            <th>Penampilan (K5)</th>
          </tr>
          </thead>

          <?php
          $id_alternatifs = $_POST['id_alternatif'];
          foreach ($id_alternatifs as $id_alternatif) {
            $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
            while ($pegawai = mysqli_fetch_assoc($data)) {
              // Konversi nilai k1
                  if ($pegawai['k1'] < 2) {
                      $nilai_k1 = 4;
                  } elseif ($pegawai['k1'] >= 2 && $pegawai['k1'] <= 2.6) {
                      $nilai_k1 = 3;
                  } elseif ($pegawai['k1'] >= 2.7 && $pegawai['k1'] <= 2.9) {
                      $nilai_k1 = 2;
                  } else {
                      $nilai_k1 = 1;
                  }

                  // Konversi nilai k2
                  if ($pegawai['k2'] < 75) {
                      $nilai_k2 = 1;
                  } elseif ($pegawai['k2'] >= 76 && $pegawai['k2'] <= 80) {
                      $nilai_k2 = 2;
                  } elseif ($pegawai['k2'] >= 81 && $pegawai['k2'] <= 88) {
                      $nilai_k2 = 3;
                  } else {
                      $nilai_k2 = 4;
                  }

                  // Konversi nilai k3
                  if ($pegawai['k3'] < 75) {
                      $nilai_k3 = 1;
                  } elseif ($pegawai['k3'] >= 76 && $pegawai['k3'] <= 80) {
                      $nilai_k3 = 2;
                  } elseif ($pegawai['k3'] >= 81 && $pegawai['k3'] <= 88) {
                      $nilai_k3 = 3;
                  } else {
                      $nilai_k3 = 4;
                  }

                  
                  // Konversi nilai k4
                  if ($pegawai['k4'] < 75) {
                      $nilai_k4 = 1;
                  } elseif ($pegawai['k4'] >= 76 && $pegawai['k4'] <= 80) {
                      $nilai_k4 = 2;
                  } elseif ($pegawai['k4'] >= 81 && $pegawai['k4'] <= 88) {
                      $nilai_k4 = 3;
                  } else {
                      $nilai_k4 = 4;
                  }

                  
                  // Konversi nilai k5
                  if ($pegawai['k5'] < 75) {
                      $nilai_k5 = 1;
                  } elseif ($pegawai['k5'] >= 76 && $pegawai['k5'] <= 80) {
                      $nilai_k5 = 2;
                  } elseif ($pegawai['k5'] >= 81 && $pegawai['k5'] <= 88) {
                      $nilai_k5 = 3;
                  } else {
                      $nilai_k5 = 4;
                  }
          ?>

              <tr>
                <td><?= $pegawai['id_alternatif']; ?></td>
                <td><?= $pegawai['nama_pegawai']; ?></td>
                <!-- -----------K1----------- -->
                <td>
                  <?php $k1 = $nilai_k1 / $akar1;
                  $pengalamanKerja1 = $pengalamanKerja['bobot'] * $k1;
                  // echo $pengalamanKerja['bobot'] . " * " . round($k1, 6) . " = " . round($pengalamanKerja1, 6);
                  echo round($pengalamanKerja1, 5);
                  ?>
                </td>
                <!-- -----------K2----------- -->
                <td>
                  <?php $k2 = $nilai_k2 / $akar2;
                  $tanggungJawab1 = $tanggungJawab['bobot'] * $k2;
                  // echo $tanggungJawab['bobot'] . " * " . round($k2, 6) . " = " . round($tanggungJawab1, 6);
                  echo round($tanggungJawab1, 5);
                  ?>
                </td>
                <!-- -----------K3----------- -->
                <td>
                  <?php $k3 = $nilai_k3 / $akar3;
                  $komunikasi1 = $komunikasi['bobot'] * $k3;
                  // echo $komunikasi['bobot'] . " * " . round($k3, 6) . " = " . round($komunikasi1, 6);
                  echo round($komunikasi1, 5);
                  ?>
                </td>
                <!-- -----------K4----------- -->
                <td>
                  <?php $k4 = $nilai_k4 / $akar4;
                  $wawasan1 = $wawasan['bobot'] * $k4;
                  // echo $wawasan['bobot'] . " * " . round($k4, 6) . " = " . round($wawasan1, 6);
                  echo round($wawasan1, 5);
                  ?>
                </td>
                <!-- -----------K5----------- -->
                <td>
                  <?php $k5 = $nilai_k5 / $akar5;
                  $penampilan1 = $penampilan['bobot'] * $k5;
                  // echo $wawasan['bobot'] . " * " . round($k4, 6) . " = " . round($wawasan1, 6);
                  echo round($penampilan1, 5);
                  ?>
                </td>
              </tr>

          <?php
            }
          }

          ?>

        </table>
      </div>


      <br><br>
     <hr>
      <br><br>

      <div class="alert alert-info">
        <center><b>HASIL AKHIR</b></center>
      </div>

      <div class="table-responsive p-4">
        <table class="table table-striped shadow">
         <thead class="custom-table-header">
            <tr>
            <th width="150">Id Alternatif</th>
            <th>Nama Pegawai</th>
            <th>Total</th>
          </tr>
          </thead>


       
          <?php
          
          $id_alternatifs = $_POST['id_alternatif'];
          foreach ($id_alternatifs as $id_alternatif) {
            $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
            while ($pegawai = mysqli_fetch_assoc($data)) {
              // Konversi nilai k1
                  if ($pegawai['k1'] < 2) {
                      $nilai_k1 = 4;
                  } elseif ($pegawai['k1'] >= 2 && $pegawai['k1'] <= 2.6) {
                      $nilai_k1 = 3;
                  } elseif ($pegawai['k1'] >= 2.7 && $pegawai['k1'] <= 2.9) {
                      $nilai_k1 = 2;
                  } else {
                      $nilai_k1 = 1;
                  }

                  // Konversi nilai k2
                  if ($pegawai['k2'] < 75) {
                      $nilai_k2 = 1;
                  } elseif ($pegawai['k2'] >= 76 && $pegawai['k2'] <= 80) {
                      $nilai_k2 = 2;
                  } elseif ($pegawai['k2'] >= 81 && $pegawai['k2'] <= 88) {
                      $nilai_k2 = 3;
                  } else {
                      $nilai_k2 = 4;
                  }

                  // Konversi nilai k3
                  if ($pegawai['k3'] < 75) {
                      $nilai_k3 = 1;
                  } elseif ($pegawai['k3'] >= 76 && $pegawai['k3'] <= 80) {
                      $nilai_k3 = 2;
                  } elseif ($pegawai['k3'] >= 81 && $pegawai['k3'] <= 88) {
                      $nilai_k3 = 3;
                  } else {
                      $nilai_k3 = 4;
                  }
                  
                  // Konversi nilai k4
                  if ($pegawai['k4'] < 75) {
                      $nilai_k4 = 1;
                  } elseif ($pegawai['k4'] >= 76 && $pegawai['k4'] <= 80) {
                      $nilai_k4 = 2;
                  } elseif ($pegawai['k4'] >= 81 && $pegawai['k4'] <= 88) {
                      $nilai_k4 = 3;
                  } else {
                      $nilai_k4 = 4;
                  }

                  
                  // Konversi nilai k5
                  if ($pegawai['k5'] < 75) {
                      $nilai_k5 = 1;
                  } elseif ($pegawai['k5'] >= 76 && $pegawai['k5'] <= 80) {
                      $nilai_k5 = 2;
                  } elseif ($pegawai['k5'] >= 81 && $pegawai['k5'] <= 88) {
                      $nilai_k5 = 3;
                  } else {
                      $nilai_k5 = 4;
                  }
          ?>


              <?php $pegawai['id_alternatif']; ?> 
              <?php $pegawai['nama_pegawai']; ?>
              <!-- -----------k2----------- -->

              <?php $k1 = $nilai_k1 / $akar1;
              $pengalamanKerja1 = $pengalamanKerja['bobot'] * $k1;
              // echo $pengalamanKerja['bobot'] . " * " . round($k1, 6) . " = " . round($pengalamanKerja1, 6);
              round($pengalamanKerja1, 5);
              ?>
              <!-- -----------k2----------- -->
              <?php $k2 = $nilai_k2 / $akar2;
              $tanggungJawab1 = $tanggungJawab['bobot'] * $k2;
              // echo $tanggungJawab['bobot'] . " * " . round($k2, 6) . " = " . round($tanggungJawab1, 6);
              round($tanggungJawab1, 5);
              ?>
              <!-- -----------C3----------- -->
              <?php $k3 = $nilai_k3 / $akar3;
              $komunikasi1 = $komunikasi['bobot'] * $k3;
              // echo $komunikasi['bobot'] . " * " . round($k3, 6) . " = " . round($komunikasi1, 6);
              round($komunikasi1, 5);
              ?>
              <!-- -----------C4----------- -->
              <?php $k4 = $nilai_k4 / $akar4;
              $wawasan1 = $wawasan['bobot'] * $k4;
              // echo $wawasan['bobot'] . " * " . round($k4, 6) . " = " . round($wawasan1, 6);
              round($wawasan1, 5);
              ?>
              <!-- -----------C5----------- -->
              <?php $k5 = $nilai_k5 / $akar5  ;
              $penampilan1 = $penampilan['bobot'] * $k5;
              // echo $wawasan['bobot'] . " * " . round($k5, 6) . " = " . round($wawasan1, 6);
              round($penampilan1, 5);
              ?> 

              <form action="" method="POST" class="form-group">
                <tr>
                  <input type="hidden" name="kode" value="<?= $kodebarang; ?>">
                  <!-- --------------ID ALTERNATIF-------------- -->
                  <input type="hidden" name="id_alternatif[]" value="<?= $pegawai['id_alternatif'] ?>">
                  <td><?= $pegawai['id_alternatif']; ?></td>
                  <!-- --------------NAMA ALTERNATIF-------------- -->
                  <input type="hidden" name="nama_pegawai[]" value="<?= $pegawai['nama_pegawai'] ?>">
                  <td><?= $pegawai['nama_pegawai']; ?></td>
                  <!-- --------------TOTAL HASIL-------------- -->
                  <td>
                    <?php
                    $totalll = $pengalamanKerja1 + $tanggungJawab1 + $komunikasi1 + $wawasan1 + $penampilan1;
                    echo round($totalll, 5);
                    ?>
                    <input type="hidden" name="total_hasil[]" value="<?= round($totalll, 5); ?>">
                  </td>
                </tr>


            <?php
            }
          }

            ?>

            <button type="submit" name="simpan" class="btn btn-dark" style="float: right;">Simpan</button>
            <br><br>
              </form>

        </table>
      </div>


    </div>
    <div class="col-md-12 custom-bg">
      <div class="copyright">
      <h5>Copyright&copy; Praktikum SI 2023</h5>
      </div>
    </div>
  <?php   } ?>
  <!-- 
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
       -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

  </body>

  </html>