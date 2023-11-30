<?php


$con = mysqli_connect("localhost:3080", "root", "", "moora");

function login($data)
{
	global $con;

	$username = $data['username'];
	$password = $data['password'];

	$login = mysqli_query($con, "SELECT * FROM login WHERE username = '$username' AND password = '$password' ");

	return mysqli_affected_rows($con);
}

function query($query)
{

	global $con;

	$data = mysqli_query($con, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($data)) {
		$rows[] = $row;
	}
	return $rows;
}

function tampilkriteria($query)
{

	global $con;

	$data = mysqli_query($con, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($data)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah_kriteria($data)
{
	global $con;

	$id_kriteria = $data['id_kriteria'];
	$nama_kriteria = $data['kriteria'];
	$bobot = $data['bobot'];
	$type = $data['type'];

	mysqli_query($con, "INSERT INTO kriteria VALUES ('$id_kriteria','$nama_kriteria','$bobot','$type') ");

	return mysqli_affected_rows($con);
}
function edit_kriteria($data)
{
	global $con;
	$id_kriteria = $data['id_kriteria'];
	$kriteria = $data['kriteria'];
	$bobot = $data['bobot'];
	$type = $data['type'];

	mysqli_query($con, "UPDATE kriteria SET 
		kriteria = '$kriteria',
		bobot = '$bobot',
		type = '$type'
		WHERE id_kriteria = '$id_kriteria'
		");

	return mysqli_affected_rows($con);
}

function hapus_kriteria($id_kriteria)
{
	global $con;

	mysqli_query($con, "DELETE FROM kriteria WHERE id_kriteria = '$id_kriteria' ");

	return mysqli_affected_rows($con);
}

function tampilpegawai($query)
{

	global $con;

	$data = mysqli_query($con, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($data)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah_pegawai($data)
{
	global $con;

	$id_alternatif = $data['id_alternatif'];
	$nama_pegawai = $data['nama_pegawai'];
	$k1 = $data['k1'];
	$k2 = $data['k2'];
	$k3 = $data['k3'];
	$k4 = $data['k4'];
	$k5 = $data['k5'];


	mysqli_query($con, "INSERT INTO alternatif VALUES ('$id_alternatif','$nama_pegawai','$k1','$k2','$k3','$k4','$k5') ");

	return mysqli_affected_rows($con);
}



function edit_pegawai($data)
{
	global $con;

	$id_alternatif = $data['id_alternatif'];
	$nama_pegawai = $data['nama_pegawai'];
	$k1 = $data['k1'];
	$k2 = $data['k2'];
	$k3 = $data['k3'];
	$k4 = $data['k4'];
	$k5 = $data['k5'];


	mysqli_query($con, "UPDATE alternatif SET
						 id_alternatif = '$id_alternatif',
						 nama_pegawai = '$nama_pegawai',
						 k1 = '$k1',
						 k2 = '$k2',
						 k3 = '$k3',
						 k4 = '$k4',
						 k5 = '$k5'
						 WHERE id_alternatif = '$id_alternatif'
						  ");

	return mysqli_affected_rows($con);
}

function hapus_pegawai($id_alternatif)
{
	global $con;

	mysqli_query($con, "DELETE FROM alternatif WHERE id_alternatif = '$id_alternatif' ");

	return mysqli_affected_rows($con);
}

function insert_hasil_perankingan($data)
{
    date_default_timezone_set('Asia/Jakarta');
    global $con;

    $kode = $data['kode'];
    $id_alternatif = $data['id_alternatif'];
    $nama_pegawai = $data['nama_pegawai'];
    $total_hasil = $data['total_hasil'];

    $tanggal = date('d - M - Y | H : i : s');

    if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM nilai WHERE kode_hasil = '$kode' "))) {
        echo "<script>
                alert('Gagal: Duplikat data')
                document.location.href='data_pegawai.php'
              </script>";
        exit;
    }

    for ($x = 0; $x < count($nama_pegawai); $x++) {
        $input = mysqli_query($con, "INSERT INTO nilai VALUES('','$kode','$id_alternatif[$x]','$nama_pegawai[$x]','$total_hasil[$x]')");
        
        if (!$input) {
            echo "<script>alert('Data Gagal Tersimpan: " . mysqli_error($con) . "')
                    document.location.href='data_pegawai.php'
                </script>";
            exit;
        }
    }

    $insert_hasil_akhir = mysqli_query($con, "INSERT INTO hasil_akhir VALUES('','$kode','$tanggal')");

    if (!$insert_hasil_akhir) {
        echo "<script>alert('Data Gagal Tersimpan: " . mysqli_error($con) . "')
                document.location.href='data_pegawai.php'
            </script>";
        exit;
    }

    return mysqli_affected_rows($con);
}


function hapus_laporan($kode)
{
	global $con;

	mysqli_query($con, "DELETE FROM hasil_akhir WHERE kode = '$kode' ");
	mysqli_query($con, "DELETE FROM nilai WHERE kode_hasil = '$kode' ");

	return mysqli_affected_rows($con);
}

function tampilsubkriteria($query)
{

	global $con;

	$data = mysqli_query($con, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($data)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah_subkriteria($data)
{
	global $con;

	$id_subkriteria = $data['id_subkriteria'];
	$id_kriteria = $data['id_kriteria'];
	$nilai = $data['nilai'];
	$bobot_subkriteria = $data['bobot_subkriteria'];


	mysqli_query($con, "INSERT INTO sub_kriteria VALUES ('$id_subkriteria','$id_kriteria','$nilai','$bobot_subkriteria') ");

	return mysqli_affected_rows($con);
}

function edit_subkriteria($data)
{
    global $con;

    $id_subkriteria = $data['id_subkriteria'];
    $id_kriteria = $data['id_kriteria'];
    $nilai = $data['nilai'];
    $bobot_subkriteria = $data['bobot_subkriteria'];

    // Perbaiki sintaks SQL di bawah
    mysqli_query($con, "UPDATE sub_kriteria SET
                        id_kriteria = '$id_kriteria',
                        nilai = '$nilai',
                        bobot_subkriteria = '$bobot_subkriteria'
                        WHERE id_subkriteria = '$id_subkriteria'");

    return mysqli_affected_rows($con);
}


function hapus_subkriteria($id_subkriteria)
{
	global $con;

	mysqli_query($con, "DELETE FROM sub_kriteria WHERE id_subkriteria = '$id_subkriteria' ");

	return mysqli_affected_rows($con);
}


