<?php 
require '../../koneksi.php';

$id = $_GET['id'];


//hapus isi tabel yang ada id_kriteria
$query = "DELETE FROM bobot_kriteria WHERE id_kriteria= '$id'";
$query_dua = "DELETE FROM nilai_produk WHERE id_kriteria= '$id'";
$query_tiga = "DELETE FROM nilai_kriteria WHERE id_kriteria= '$id'";
$query_empat = "DELETE FROM kriteria WHERE id_kriteria = '$id'";
//kondisi
	if ($koneksi->query($query) AND $koneksi->query($query_dua) AND $koneksi->query($query_tiga) AND $koneksi->query($query_empat)===TRUE){
	    header("location: ../../../page/kriteria.php?pesan=hapus");
	}else{
	    $result='failed'.$koneksi->error;
	}

?>