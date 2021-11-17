<?php 
require '../../koneksi.php';

$id_kategori 		= @$_POST['id_kategori'];
$id_kriteria 		= @$_POST['id_kriteria'];
$nilai 				= @$_POST['nilai'];
$id_kriteria_plus	= @$_POST['id_kriteria_plus'];
$nilai_plus			= @$_POST['nilai_plus'];


$jumlah=0;
$ksg=0;
if ($nilai_plus) {
	foreach ($nilai_plus as $data) {
		if($data==''){ //jika ada nilai_plus kosong
			$ksg++;
		}else{
			$jumlah++;
		}
	}
}

if ($jumlah>0) {
	//kondisi nilai kosong diunset bersama dengan id_kriteria
	foreach ($nilai_plus as $kunci => $bobot) {
		if (empty($bobot)) {
			$key_kosong_plus[] = $kunci;
			unset ($nilai_plus[$kunci]);
		}
	}

	foreach ($key_kosong_plus as $key_kosong_plus) {
		foreach ($id_kriteria_plus as $kunci => $bobot) {
			if ($kunci == $key_kosong_plus) {
					$query = "DELETE FROM bobot_kriteria WHERE id_kategori=$id_kategori AND id_kriteria= $bobot";
					$data = mysqli_query($koneksi, $query);
					unset($id_kriteria_plus[$kunci]);
			}
		}
	}//end unset


	//Reset Array Index
	$id_kriteria_plus_array	= array_values($id_kriteria_plus);
	$nilai_plus_array		= array_values($nilai_plus);

	for ($i=0; $i <count($nilai_plus_array); $i++) { 
		$query = "INSERT INTO bobot_kriteria(id_kategori, id_kriteria, bobot) VALUES ('$id_kategori', '$id_kriteria_plus_array[$i]', '$nilai_plus_array[$i]')";
		$data = $koneksi->query($query);
	}
	//kondisi nilai kosong diunset bersama dengan id_kriteria
	foreach ($nilai as $key => $value) {
		if (empty($value)) {
			$key_kosong[] = $key;
			unset ($nilai[$key]);
		}
	}

	foreach ($key_kosong as $key_kosong) {
		foreach ($id_kriteria as $key => $value) {
			if ($key == $key_kosong) {
					$query = "DELETE FROM bobot_kriteria WHERE id_kategori=$id_kategori AND id_kriteria= $value";
					$data = mysqli_query($koneksi, $query);
					unset($id_kriteria[$key]);
			}
		}
	}//end unset


	//Reset Array Index
	$id_kriteria_array	= array_values($id_kriteria);
	$nilai_array		= array_values($nilai);

	if (empty($nilai_array)) {
		for ($i=0; $i < count($nilai_array); $i++) { 
			$query = "UPDATE bobot_kriteria SET bobot = $nilai_array[$i]  WHERE id_kategori = $id_kategori AND $id_kriteria_array[$i]";
			$data = $koneksi->query($query);
		}
	}

	header('location: ../../page/bobot.php?pesan=edit');

}else{

	//kondisi nilai kosong diunset bersama dengan id_kriteria
	foreach ($nilai as $key => $value) {
		if (empty($value)) {
			$key_kosong[] = $key;
			unset ($nilai[$key]);
		}
	}

	foreach ($key_kosong as $key_kosong) {
		foreach ($id_kriteria as $key => $value) {
			if ($key == $key_kosong) {
					$query = "DELETE FROM nilai_produk WHERE id_kategori = $id_kategori AND id_kriteria= $value";
					$query_dua = "DELETE FROM bobot_kriteria WHERE id_kategori=$id_kategori AND id_kriteria= $value";

					$data = mysqli_query($koneksi, $query);
					$data_dua = mysqli_query($koneksi, $query_dua);

					unset($id_kriteria[$key]);
			}
		}
	}//end unset


	//Reset Array Index
	$id_kriteria_array	= array_values($id_kriteria);
	$nilai_array		= array_values($nilai);

	if (empty($nilai_array)) {
		for ($i=0; $i < count($nilai_array); $i++) { 
			$query = "UPDATE bobot_kriteria SET bobot = $nilai_array[$i]  WHERE id_kategori = $id_kategori AND $id_kriteria_array[$i]";
			$data = $koneksi->query($query);
		}
	}

	header('location: ../../page/bobot.php?pesan=edit');
}




die;
###########################################################
###########################################################
###########################################################
###########################################################



$total = count($id_kriteria_array);
$query="SELECT bobot_kriteria.`id_kriteria` FROM bobot_kriteria WHERE id_kategori=$id_kategori";
$data = mysqli_query($koneksi, $query);

print_r($id_kriteria_array);echo 'data $id_kriteria<br>';
print_r($nilai_array);echo 'data $nilai<br>';


#iki nek pakai query pake num_rows
$row_kirteria = count($id_kriteria_array);//3
$row_nilai = count($nilai_array);//3
$tmp=0;
foreach ($data as $data) {//3
	echo $id_kriteria_tmp = $data['id_kriteria'];
    for($i=0; $i<$row_kirteria; $i++){//3
        if($id_kriteria_tmp == $id_kriteria_array[$i]){
            #update data
            $query = "UPDATE bobot_kriteria SET bobot = $nilai_array[$i] WHERE id_kategori=$id_kategori AND id_kriteria=$id_kriteria_array[$i]";
            $data = $koneksi->query($query);

            }else{
            	
			        $query = "INSERT INTO bobot_kriteria(id_kategori, id_kriteria, bobot) VALUES ($id_kategori, $id_kriteria_array[$i],$nilai_array[$i])";
					$data = $koneksi->query($query); 
					
            	
            
            } 
        }
     
    }
die;
