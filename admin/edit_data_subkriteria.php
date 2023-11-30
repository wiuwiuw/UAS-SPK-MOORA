<?php

session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['status'])) {
  header("Location: ../index.php?pesan=logindahulu");
  exit;
}


require '../functions.php';

//AMBIL DATA YG DIKLIK EDIT DI HALAMAN data_subkriteria.php TADI 
$id_subkriteria = $_GET['id_subkriteria'];

//TAMPILKAN DATA DIMANA id_subkriteria nya ADALAH $id_subkriteria
$data_subkriteria = tampilsubkriteria("SELECT * FROM sub_kriteria WHERE id_subkriteria = '$id_subkriteria' ")[0];

//JIKA DIKLIK BUTTON EDIT MAKA
if (isset($_POST['edit'])) {
  //JIKA function edit_pegawai > 0 (sukses) MAKA JALANKAN FUNGSI
  if (edit_subkriteria($_POST) > 0) {
    echo "<script>
          alert ('Data Berhasil Di Edit')
          document.location.href='data_subkriteria.php'
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
      color: #CDD0D4
    }

    a font {
      color: whitesmoke;
    }

    .navbar-nav a:hover {
      color: darkblue;

    }
  </style>

  <title>EDIT DATA SUB KRITERIA</title>
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
          <a class="nav-link" href="data_subkriteria.php">
            <font size="4"><b>Data Calon Kepala Direktur</b></font>
          </a>
          <a class="nav-link" href="#">
            <font size="4"><b><button type="submit" name="perhitungan" class="btn btn-primary" style="font-size: 20px; margin-top: -10px;"><b>Perhitungan</b></button></b></font>
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
      <center><b>EDIT DATA PEGAWAI</b></center>
    </div>

    <div class="col-md-7">
      <form method="post" class="form-group">
        <table class="table">

          <tr>
            <td width="200"><label>Id Sub Kriteria</label></td>
            <td> : </td>
            <td width="500"><input type="text" name="id_subkriteria" value="<?= $data_subkriteria['id_subkriteria']; ?>" readonly class="form-control" autocomplete="off"></td>
          </tr>

          <tr>
        <td><label>Nama Kriteria</label></td>
        <td> : </td>
        <td width="500">
          <select name="id_kriteria" class="form-control" autocomplete="off">
            <?php
            // Pastikan $con sudah didefinisikan dengan benar di functions.php
            global $con;

            // Ambil data kriteria dari database
            $query_kriteria = mysqli_query($con, "SELECT * FROM kriteria");
            while ($row_kriteria = mysqli_fetch_assoc($query_kriteria)) :
            ?>
              <option value="<?= $row_kriteria['id_kriteria']; ?>" <?php if ($row_kriteria['id_kriteria'] == $data_subkriteria['id_kriteria']) echo 'selected'; ?>>
                <?= $row_kriteria['kriteria']; ?>
              </option>
            <?php endwhile; ?>
          </select>
        </td>
      </tr>

          <tr>
              <td><label>Nilai</label></td>
              <td> : </td>
              <td width="500"> <input type="text" name="nilai" value="<?= $data_subkriteria['nilai']; ?>" class="form-control" autocomplete="off"></td>
            </tr>

          <tr>
            <td><label>Bobot Sub Kriteria</label></td>
            <td> : </td>
            <td width="500"> <input type="text" name="bobot_subkriteria" value="<?= $data_subkriteria['bobot_subkriteria']; ?>" class="form-control" autocomplete="off"></td>
          </tr>


          <td></td>
          <td></td>
          <td><button type="submit" name="edit" class="btn btn-warning">Edit </button> &nbsp;&nbsp;&nbsp;
            <a href="data_subkriteria.php" class="btn btn-danger">Batal</a>
          </td>
          </tr>
        </table>

      </form>
    </div>

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
  <script src="http://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>

</html>