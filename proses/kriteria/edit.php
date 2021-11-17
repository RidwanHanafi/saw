<?php 
require '../../koneksi.php';

$id = @$_POST['id'];
$nama = @$_POST['nama'];
$sifat = @$_POST['sifat'];

$query = 	"UPDATE kriteria
			SET nama_kriteria = '$nama', sifat = '$sifat'
			WHERE id_kriteria = '$id'";
	//kondisi
	if ($koneksi->query($query)===TRUE){
	    header("location: ../../page/kriteria.php?pesan=edit", true, 301);
	}else{
	   echo "Koneksi Gagal.".$koneksi->connect_error;
	}
 ?>

