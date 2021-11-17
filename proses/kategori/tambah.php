<?php 
require '../../koneksi.php';

// $id = @$_POST['id'];
// $op = @$_POST['op'];
$kategori= @$_POST['kategori'];
$cek=strtolower($kategori);
if ($cek) {
	$query = "SELECT nama_kategori FROM kategori WHERE nama_kategori ='$cek'";
	$data = $koneksi->query($query);
	foreach ($data as $data) {
		$data_cek=strtolower($data['nama_kategori']);
	}
	
}
similar_text($cek, $data_cek, $persen);

if($persen == 100){
	header("location: ../../page/kategori.php?pesan=sama", true, 301);
	die;
}
//insert tabel kategori
$query = "INSERT INTO kategori (nama_kategori) VALUES ('$kategori')";
	//kondisi
	if ($koneksi->query($query)===TRUE){
	    header("location: ../../page/kategori.php?pesan=tambah", true, 301);
	}else{
	    $result='failed'.$koneksi->error;
	}

?>

