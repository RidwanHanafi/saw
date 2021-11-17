<?php 
require '../../koneksi.php';

// $id = @$_POST['id'];
// $op = @$_POST['op'];
$kriteria = @$_POST['kriteria'];
$nilai = @$_POST['nilai'];
$keterangan = @$_POST['keterangan'];

//insert tabel kategori
$query = "INSERT INTO nilai_kriteria (id_kriteria, nilai, keterangan) VALUES ('$kriteria','$nilai','$keterangan')";
	//kondisi
	if ($koneksi->query($query)===TRUE){
	    header("location: ../../page/subkriteria.php?pesan=tambah", true, 301);
	}else{
	    $result='failed'.$koneksi->error;
	}

?>

