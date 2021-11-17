<?php 
require '../../koneksi.php';

// $id = @$_POST['id'];
// $op = @$_POST['op'];
$kriteria= @$_POST['kriteria'];
$sifat = @$_POST['sifat'];

//insert tabel kategori
$query = "INSERT INTO kriteria (nama_kriteria,sifat) VALUES ('$kriteria','$sifat')";
	//kondisi
	if ($koneksi->query($query)===TRUE){
	    header("location: ../../page/kriteria.php?pesan=tambah", true, 301);
	}else{
	    $result='failed'.$koneksi->error;
	}

?>

