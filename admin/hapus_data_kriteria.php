<?php

require '../functions.php';

//AMBIL DATA YG DIKLIK HAPUS DI HALAMAN data_pegawai.php TADI 
$id_kriteria = $_GET['id_kriteria'];

//JALANKAN FUNGSI HAPUS
if (hapus_kriteria($id_kriteria)) {
    echo "<script>
          alert ('Kriteria Berhasil Di Hapus')
          document.location.href='data_kriteria.php'
          </script>";
}
