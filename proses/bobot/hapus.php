<?php 
require '../../koneksi.php';

$id = $_GET['id'];



//hapus isi tabel nilai_kriteria
$query_dua = "DELETE FROM nilai_produk WHERE id_kategori = $id";

$query_tiga = "DELETE FROM hasil WHERE id_kategori = $id";

//hapus isi tabel bobot_kriteria
$query = "DELETE FROM bobot_kriteria WHERE id_kategori = $id";
//kondisi
	if ($koneksi->query($query) AND $koneksi->query($query_dua) AND $koneksi->query($query_tiga) ===TRUE){
	    header("location: ../../../page/bobot.php?pesan=hapus");
	}else{
	    $result='failed'.$koneksi->error;
	}

 ?>