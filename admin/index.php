<?php

session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['status'])) {
  header("Location: ../index.php?pesan=logindahulu");
  exit;
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
      background-image: url(../image/emina/logo.png);
      background-size: cover;
    }

    .gambar {
      max-width: 60%;
      height: auto;
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
      color: pink;

    }

    @media (max-width: 1000px) {
      .judul {
        font-size: 3vh;
      }
    }
  </style>

  <title>Home</title>
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
          <a class="nav-link" href="data_subkriteria.php">
            <font size="4"><b>Data Sub Kriteria</b></font>
          </a>
          <a class="nav-link" href="data_pegawai.php">
            <font size="4"><b>Data Pegawai</b></font>
          </a>
          <a class="nav-link" href="#">
            <font size="4"><b>Perhitungan</b></font>
          </a>
          <a class="nav-link" href="laporan.php">
            <font size="4"><b>Laporan</b></font>
          </a>
          <a class="nav-link" href="tentang.php">
            <font size="4"><b>Tentang</b></font>
          </a>
        </div>
        <div class="navbar-nav ms-auto" style="margin: 10px;">
          <a class="log nav-link m-auto" href="../logout.php">
            <font size="4"><b>Logout</b></font>
            <img src="../image/logout.png" width="30">
          </a>
        </div>
      </div>
    </nav>
  </form>

  <br>
  <div class="container bg-light shadow p-3 mb-5">
    <div class="alert alert-info">
      <center><b>SELAMAT DATANG ADMIN</b></center>
    </div>
    <br>
    <center>
      <font size="5" class="judul"><b>Implementasi Metode MOORA dalam Sistem Pendukung Keputusan Pemilihan Calon Kepala Direktur Terbaik(Study Kasus : Jurnal)</b></font>
    </center>

    <br><br>

    <center>

      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../image/paragon.png" width="300" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../image/emina/6.png" width="300" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../image/emina/7.png" width="300" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item ">
            <img src="../image/emina/3.png" width="300" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../image/emina/8.png" width="300" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../image/emina/5.png" width="300" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

    </center>

    <br>
  </div>

  <div class="col-md-12 custom-bg">
    <div class="copyright">
      <h6>Copyright&copy; Praktikum SI 2023</h6>
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>