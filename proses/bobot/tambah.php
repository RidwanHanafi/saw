<?php 
require '../../koneksi.php';

$id_kategori 	= @$_POST['id_kategori'];
$id_kriteria 	= @$_POST['id_kriteria'];
$nilai 			= @$_POST['nilai'];

$cek = 0;
for($i=0; $i<count($nilai); $i++){
	if($nilai[$i]==-1){
		$cek++;
	}
}

if($cek<count($nilai)){
	foreach ($nilai as $key => $value) {
		if ($value=='-1') {
			$key_kosong[] = $key;
			unset ($nilai[$key]);
		}
	}

	foreach ($key_kosong as $key_kosong) {
		foreach ($id_kriteria as $key => $value) {
			if ($key == $key_kosong) {
				unset($id_kriteria[$key]);

			}
		}
	}
	
//Reset Array Index
$id_kriteria = array_values($id_kriteria);
$nilai		 = array_values($nilai);

	$verify=0;
	for($i=0; $i<count($id_kriteria);$i++){
			$query = "INSERT INTO bobot_kriteria (id_kategori, id_kriteria, bobot) VALUES ('$id_kategori','$id_kriteria[$i]','$nilai[$i]')";
			$koneksi->query($query);
			$verify++;
	}
		//kondisi
		if ($verify==count($id_kriteria)){
		    header("location: ../../page/bobot.php?pesan=tambah", true, 301);
		}else{
		    $result='failed'.$koneksi->error;
		}	
}else{
	header("location: ../../page/bobot.php?pesan=nol", true, 301);
}


?>

