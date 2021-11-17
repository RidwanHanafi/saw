<?php 
require '../../koneksi.php';

$id = @$_GET['id'];


//hapus isi tabel kategori

$query = "DELETE FROM nilai_kriteria WHERE id_nilai_kriteria = $id ";
//kondisi
	if ($koneksi->query($query)===TRUE){
	    header("location: ../../../page/subkriteria.php?pesan=hapus");
	}else{
	    $result='failed'.$koneksi->error;
	}

 ?>