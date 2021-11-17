<?php 
require '../../koneksi.php';

$id_kategori 		= @$_POST['kategori'];
$id_produk	 		= @$_POST['produk'];
$id_kriteria 		= @$_POST['kriteria'];
$id_nilai_kriteria 	= @$_POST['nilai_kriteria'];
$id_user 			= @$_POST['id_user'];


//cek data apakah sudah ada atau belum
$query = "SELECT id_produk FROM nilai_produk GROUP BY id_produk";
$data = mysqli_query($koneksi, $query);

foreach ($data as $data) {
	 $cek[] = $data['id_produk'];
}


	if(in_array($id_produk, $cek)){
		header("location: ../../page/penilaian.php?pesan=sama", true, 301);
	}else if(empty($id_produk)){
		header("location: ../../page/penilaian.php?pesan=kosong", true, 301);
	}else if(in_array('-1',$id_nilai_kriteria)){
		header("location: ../../page/penilaian.php?pesan=nol", true, 301);
	}else{
		$verify=0;
	for($i=0; $i<count($id_kriteria);$i++){
		$query= "INSERT INTO nilai_produk(id_produk,id_kategori,id_kriteria,id_nilai_kriteria, id_user) VALUES('$id_produk','$id_kategori','$id_kriteria[$i]','$id_nilai_kriteria[$i]','$id_user')";
		$koneksi->query($query);
		$verify++;
	}
		//kondisi
		if ($verify==count($id_kriteria)){
		    header("location: ../../page/penilaian.php?pesan=tambah", true, 301);
		}else{
		    $result='failed'.$koneksi->error;
		}
	}

