<?php 
require '../../koneksi.php';

$id = $_GET['id'];

//hapus isi tabel 
$query_dua = "DELETE FROM hasil WHERE id_produk = '$id'";

$query = "DELETE FROM nilai_produk WHERE id_produk = '$id'";

//kondisi
	if ($koneksi->query($query) AND $koneksi->query($query_dua)===TRUE){
	    header("location: ../../../page/penilaian.php?pesan=hapus");
	}else{
	    $result='failed'.$koneksi->error;
	}

 ?>