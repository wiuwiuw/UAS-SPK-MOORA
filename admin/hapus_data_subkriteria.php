<?php

require '../functions.php';

//AMBIL DATA YG DIKLIK HAPUS DI HALAMAN data_subkriteriaa.php TADI 
$id_subkriteria = $_GET['id_subkriteria'];

//JALANKAN FUNGSI HAPUS
if (hapus_subkriteria($id_subkriteria)) {
    echo "<script>
          alert ('Data Berhasil Di Hapus')
          document.location.href='data_subkriteria.php'
          </script>";
}
