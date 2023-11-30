<?php

session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['status'])) {
  header("Location: ../index.php?pesan=logindahulu");
  exit;
}

require '../functions.php';

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

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
      color: darkblue;
    }

    .anggota1 {
    width: 230px;
    height: 100px;
    margin-left: 150px;
    margin-top: 40px;
    border: 1px solid grey;
    float: left;
    position: absolute;
    }

    .anggota2 {
        width: 230px;
        height: 100px;
        border: 1px solid grey;
        float: left;
        margin-left: 450px; /* Jarak antara visi dan misi */
        margin-top: 40px; /* Sesuaikan dengan margin-top visi */
    }

    .anggota3 {
        width: 230px;
        height: 100px;
        border: 1px solid grey;
        float: left;
        margin-left: 750px; /* Jarak antara misi dan anggota3 */
        margin-top: -100px; /* Sesuaikan dengan margin-top visi */
    }


    @media (max-width: 1000px) {
      .anggota1 {
        width: 90%;
        margin-top: -250px;
      }

      .anggota2 {
        width: 90%;
        margin-left: 0;
        margin-top: -50px;
      }

      .anggota3 {
        width: 90%;
        margin-top: -50px;
      }

      .telp {
        margin-right: 350px;
        margin-bottom: 10px;

      }

      .alamat {
        margin-right: 350px;
        margin-bottom: 10px;
      }


      .email {
        margin-right: 350px;
        margin-bottom: 10px;
      }


    }
  </style>

  <title>Tentang Kami</title>
</head>

<body bgcolor="f0f0f0">
  <nav class="navbar navbar-expand-lg navbar-dark  custom-bg">
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
        <!-- membuat tobol logout menjadi lebih ke kanan dan bisa menyesuaikan di mobile juga. 1&nbsp = 1x spasi -->
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a class="log nav-link" href="../logout.php">
          <font size="4"><b>Logout</b></font>
          <img src="../img/logout.png" width="30">
        </a>
      </div>
    </div>
  </nav>

  <br>
  <div class="container bg-light shadow p-3 mb-5">

    <div class="alert alert-info">
      <center><b>TENTANG KAMI</b></center>
    </div>
    <center>
         Sistem ini merupakan sistem pemilihan calon di rektur untuk perusahan PT. Paragon. Sistem ini dibuat untuk memenuhi tugas ujian akhir semester mata kuliah Praktikum Sistem Informasi
    </center>

    <br><br><br>

    <center>
      <h5><b>ANGGOTA KELOMPOK</b></H4>
    </center>
    <hr>

    <!--<center><img src="../img/visi-misi.png" width="300" style="position: fixed;margin-left: 0%;position: relative; opacity: 60%;"></center> -->

    <center>

      <div class="anggota1 shadow">
        <h5><b>Eka Mira Novita S</b></h5>
        <font>210605110056.</font>
      </div>

      <div class="anggota2 shadow">
        <h5><b>Sita Maulidia Alyatu Z</b></h5>
        <font>210605110068</font>
      </div>

      <div class="anggota3 shadow">
        <h5><b>Nafiah Nur Muttaqin</b></h5>
        <font>210605110127</font>
      </div>
      

      <br><br><br>

    </center>

    <br><br>
    <br><br>
    <br><br>

    <center>
      <h6><b>KONTAK KAMI</b></H4>
    </center>
    <hr>
    <br>

    <img class="telp" src="../img/phone.png" width="30" style="float: left">
    <font class="telp2">0812 - 4321- 5286</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <img class="alamat" src="../img/pin.png" width="30">
    <font class="alamat2">JL. Gajayana No. 19/21 Malang</font>

    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <img class="email" src="../img/email.png" width="30">
    <font class="email2">ParagonGroup@gmail.com</font>
  </div>

  <div class="col-md-12 custom-bg">
    <div class="copyright">
      <h5>Copyright&copy; Praktikum SI 2023</h5>
    </div>
</div>


  <!-- 
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
   -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>

</html>