<?php 
require '../../koneksi.php';

$id = @$_POST['id'];
$kriteria = @$_POST['kriteria'];
$nilai = @$_POST['nilai'];
$keterangan = @$_POST['keterangan'];

$query = 	"UPDATE nilai_kriteria
			SET id_kriteria = '$kriteria', nilai = '$nilai', keterangan = '$keterangan'
			WHERE id_nilai_kriteria = '$id'";
	//kondisi
	if ($koneksi->query($query)===TRUE){
	    header("location: ../../page/subkriteria.php?pesan=edit", true, 301);
	}else{
	   echo "Koneksi Gagal.".$koneksi->connect_error;
	}
// if(isset($id) AND isset($kriteria) AND isset($nilai) AND isset($keterangan)){
	
// }else{
// 	echo 'error';
// }

 ?>

