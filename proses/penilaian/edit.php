<?php 
require '../../koneksi.php';


$id_nilai_kriteria 	= $_POST['id_nilai_kriteria'];
$id_kriteria 		= $_POST['id_kriteria'];
$id_produk 			= $_POST['id_produk'];
$id_kategori 		= $_POST['id_kategori'];
$id_user 			= $_POST['id_user'];

$id_nilai_kriteria_plus[] = $_POST['id_nilai_kriteria_plus'];
$id_kriteria_plus 		= $_POST['id_kriteria_plus'];

$jumlah=1;
foreach ($id_nilai_kriteria_plus as $id_nilai_kriteria_plus) {
	$jumlah++;
}


if ($jumlah>0) {
	
	for ($i=0; $i <$jumlah; $i++) { 
		$query = "INSERT INTO nilai_produk(id_produk,id_kategori,id_kriteria,id_nilai_kriteria, id_user) VALUES('$id_produk','$id_kategori','$id_kriteria_plus[$i]','$id_nilai_kriteria_plus[$i]','$id_user')";
		$koneksi->query($query);
	}

	$verify=0;

	for($i=0; $i<count($id_kriteria); $i++){

	$query = 	"UPDATE nilai_produk
				SET id_nilai_kriteria = $id_nilai_kriteria[$i], id_user = $id_user
				WHERE id_produk = $id_produk
				AND id_kriteria =$id_kriteria[$i]";


	$koneksi->query($query);
	$verify++;

	}
		//kondisi
		if ($verify==count($id_kriteria)){
		    header("location: ../../page/penilaian.php?pesan=edit", true, 301);
		}else{
		   echo "Koneksi Gagal.".$koneksi->connect_error;
		}

}else{

	$verify=0;

	for($i=0; $i<count($id_kriteria); $i++){

	$query = 	"UPDATE nilai_produk
				SET id_nilai_kriteria = $id_nilai_kriteria[$i], id_user = $id_user
				WHERE id_produk = $id_produk
				AND id_kriteria =$id_kriteria[$i]";


	$koneksi->query($query);
	$verify++;

	}
		//kondisi
		if ($verify==count($id_kriteria)){
		    header("location: ../../page/penilaian.php?pesan=edit", true, 301);
		}else{
		   echo "Koneksi Gagal.".$koneksi->connect_error;
		}
}
 ?>

