<?php 
require '../../koneksi.php';

$id = $_GET['id'];



//hapus isi tabel produk
$query = "DELETE FROM produk WHERE id_kategori = $id";

//hapus isi tabel bobot_kriteria
$query_dua = "DELETE FROM bobot_kriteria WHERE id_kategori = $id";

//hapus isi tabel nilai_produk
$query_tiga = "DELETE FROM nilai_produk WHERE id_kategori = $id";

//hapus isi tabel hasil
$query_empat = "DELETE FROM hasil WHERE id_kategori = $id";

//hapus isi tabel krategori
$query_lima = "DELETE FROM kategori WHERE id_kategori = $id";

//kondisi
	if ($koneksi->query($query) AND $koneksi->query($query_dua) AND $koneksi->query($query_tiga) AND $koneksi->query($query_empat) AND $koneksi->query($query_lima)===TRUE){
	    header("location: ../../../page/kategori.php?pesan=hapus");
	}else{
	    $result='failed'.$koneksi->error;
	}

 ?>