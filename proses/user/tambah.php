<?php 
require '../../koneksi.php';


$email 		= @$_POST['email'];
$username	= @$_POST['username'];
$password	= md5(@$_POST['password']);
$level		= @$_POST['level'];
$gambar 	= @$_FILES['gambar']['name'];
$tmp 		= @$_FILES['gambar']['tmp_name'];
$jenis_gambar = @$_FILES['gambar']['type'];

//cek kondisi apakah email sudah ada atau belum
$query = "SELECT * FROM user WHERE email ='$email'";
$hasil = $koneksi->query($query);
$cek = $hasil->fetch_object();

if($cek->email==$email){
	header("location: ../../page/user.php?pesan=gagal");
}else{
//end cek kondisi

	$fotobaru = date('dmYHis').$gambar;
	$path = "../../assets/gambar/profil/".$fotobaru;

	// jika foto kosong 
	if (empty($gambar)) {
		$no_foto = "../../assets/gambar/noimage.jpg";

	  $query = "INSERT INTO user(email, username, password, level, status_user) VALUES('$email','$username','$password','$level','aktif')";

	  if($koneksi->query($query)===TRUE){ // Cek jika proses simpan ke database sukses atau tidak
	    // Jika Sukses, Lakukan :
	    header("location: ../../page/user.php?pesan=tambah", true, 301); // Redirect ke halaman index.php
	  }else{
	    // Jika Gagal, Lakukan :
	  header("location: ../../page/user.php?pesan=salah", true, 301);
	  }

	} else{

		if ($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png" AND $ukuran_gambar < 5242880) {
			// Proses upload
			if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
				// Proses simpan ke Database
				$query = "INSERT INTO user(email, username, password, level, status_user, gambar) VALUES('$email','$username','$password','$level', 'aktif', '$fotobaru')";

				if($koneksi->query($query)===TRUE){ // Cek jika proses simpan ke database sukses atau tidak
				// Jika Sukses, Lakukan :
				header("location: ../../page/user.php?pesan=tambah", true, 301); // Redirect ke halaman index.php
				}else{
				// Jika Gagal, Lakukan :
				header("location: ../../page/user.php?pesan=salah", true, 301);
				}
			}else{
				// Jika gambar gagal diupload, Lakukan :
				header("location: ../../page/user.php?pesan=gagal", true, 301);
			}

		}else{
			header("location: ../../page/user.php?pesan=max", true, 301);
		}
	}


}
?>

