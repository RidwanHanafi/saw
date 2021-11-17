<?php 
require '../../koneksi.php';

$id = $_GET['id'];


//hapus isi tabel produk
$query = "DELETE FROM user WHERE id_user = $id";


//kondisi
	if ($koneksi->query($query)===TRUE){
	    header("location: ../../../page/user.php?pesan=hapus");
	}else{
	    $result='failed'.$koneksi->error;
	}

 ?>