<?php 
require '../../koneksi.php';

$id = @$_POST['id'];
$nama = @$_POST['nama'];

$query = 	"UPDATE kategori
			SET nama_kategori = '$nama'
			WHERE id_kategori = '$id'";
	//kondisi
	if ($koneksi->query($query)===TRUE){
	    header("location: ../../page/kategori.php?pesan=edit", true, 301);
	}else{
	   echo "Koneksi Gagal.".$koneksi->connect_error;
	}
 ?>

