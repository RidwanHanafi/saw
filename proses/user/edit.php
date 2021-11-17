<?php 
require '../../koneksi.php';

$id_user 	= @$_POST['id_user'];
$email 		= @$_POST['email'];
$username	= @$_POST['username'];
//cek kondisi password
if (empty($_POST['password'])) {
	$password =='';
}else{
	$password	= md5(@$_POST['password']);
	$pw			= @$_POST['password'];
}

$level		= @$_POST['level'];
$status_user= @$_POST['status_user'];
$gambar 	= @$_FILES['gambar']['name'];
$tmp 		= @$_FILES['gambar']['tmp_name'];
$jenis_gambar = @$_FILES['gambar']['type'];
$ukuran_gambar= @$_FILES['gambar']['size'];

// jika level kosong (page profil)

if ($level=='') {
	
	if (empty($gambar) AND empty($password)) {
		$query = "UPDATE user SET username = '$username' WHERE id_user = '$id_user'";
		if ($koneksi->query($query)===TRUE) {
			// Jika Sukses, Lakukan :
			header("location: ../../page/profil.php?pesan=edit", true, 301); // Redirect ke halaman produk.php
		}else{
			// Jika Gagal, Lakukan :
			header("location: ../../page/profil.php?pesan=gagal", true, 301);
		}	
		
	}elseif(empty($gambar)){
		if (strlen($pw)<=5) {
			header("location: ../../page/profil.php?pesan=min", true, 301);
		}else{
			$query = "UPDATE user SET username = '$username', password='$password' WHERE id_user = '$id_user'";
			if ($koneksi->query($query)===TRUE) {
				// Jika Sukses, Lakukan :
				header("location: ../../page/profil.php?pesan=edit", true, 301); // Redirect ke halaman produk.php
			}else{
				// Jika Gagal, Lakukan :
				header("location: ../../page/profil.php?pesan=gagal", true, 301);
			}
		}	
		
	}elseif (empty($password)) {

		if ($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png" AND $ukuran_gambar < 5242880) {
			// Lakukan proses update termasuk mengganti foto sebelumnya
			$fotobaru = date('dmYHis').$gambar;// Rename nama fotonya dengan menambahkan tanggal dan jam upload
			// Set path folder tempat menyimpan fotonya
			$path = "../../assets/gambar/profil/".$fotobaru;

			if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
				// Query untuk menampilkan data gambar berdasarkan ID yang dikirim
				$query = "SELECT gambar FROM user WHERE id_user='$id_user'";
				$data = $koneksi->query($query);
				$tmp = $data->fetch_object();
				// Jika foto ada
				if(is_file("../../assets/gambar/profil/".$tmp->gambar))
				unlink("../../assets/gambar/profil/".$tmp->gambar); // Hapus file foto sebelumnya yang ada di folder images
				// Proses ubah data ke Database
				$query_dua = "UPDATE user SET username = '$username', gambar='$fotobaru' WHERE id_user='$id_user'";
				if($koneksi->query($query_dua)===TRUE){ // Cek jika proses simpan ke database sukses atau tidak
					// Jika Sukses, Lakukan :
					header("location: ../../page/profil.php?pesan=edit", true, 301); // Redirect ke halaman index.php
				}else{
					// Jika Gagal, Lakukan :
					header("location: ../../page/profil.php?pesan=error", true, 301);
				}
			}else{
				// Jika gambar gagal diupload, Lakukan :
				header("location: ../../page/profil.php?pesan=gagal", true, 301);
			}
		}else{
			// Jika gambar gagal diupload, Lakukan :
			header("location: ../../page/profil.php?pesan=max", true, 301);
		}
	}
	else{ // Jika user memilih foto / mengisi input file foto pada form
		if ($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png" AND $ukuran_gambar < 5242880) {
			// Lakukan proses update termasuk mengganti foto sebelumnya
			$fotobaru = date('dmYHis').$gambar;// Rename nama fotonya dengan menambahkan tanggal dan jam upload
			// Set path folder tempat menyimpan fotonya
			$path = "../../assets/gambar/profil/".$fotobaru;

			if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
				// Query untuk menampilkan data gambar berdasarkan ID yang dikirim
				$query = "SELECT gambar FROM user WHERE id_user='$id_user'";
				$data = $koneksi->query($query);
				$tmp = $data->fetch_object();
				// Jika foto ada
				if(is_file("../../assets/gambar/profil/".$tmp->gambar))
				unlink("../../assets/gambar/profil/".$tmp->gambar); // Hapus file foto sebelumnya yang ada di folder images
				// Proses ubah data ke Database
				$query_dua = "UPDATE user SET username = '$username', password='$password', gambar='$fotobaru' WHERE id_user='$id_user'";
				if($koneksi->query($query_dua)===TRUE){ // Cek jika proses simpan ke database sukses atau tidak
					// Jika Sukses, Lakukan :
					header("location: ../../page/profil.php?pesan=edit", true, 301); // Redirect ke halaman index.php
				}else{
					// Jika Gagal, Lakukan :
					header("location: ../../page/profil.php?pesan=error", true, 301);
				}
			}else{
				// Jika gambar gagal diupload, Lakukan :
				header("location: ../../page/profil.php?pesan=gagal", true, 301);
			}
		}else{
			// Jika gambar gagal diupload, Lakukan :
			header("location: ../../page/profil.php?pesan=max", true, 301);
		}
	}
}//end if level kosong

//level ada (page user)
else{

	if (empty($gambar) AND empty($password)) {
		$query = "UPDATE user SET username = '$username', level = '$level', status_user = '$status_user' WHERE id_user = '$id_user'";
		if ($koneksi->query($query)===TRUE) {
			// Jika Sukses, Lakukan :
			header("location: ../../page/user.php?pesan=edit", true, 301); // Redirect ke halaman produk.php
		}else{
			// Jika Gagal, Lakukan :
			header("location: ../../page/user.php?pesan=gagal", true, 301);
		}	
		
	}elseif(empty($gambar)){
		if (strlen($pw)<=5) {
			header("location: ../../page/user.php?pesan=min", true, 301);
		}else{
			$query = "UPDATE user SET username = '$username', password='$password', level = '$level', status_user = '$status_user' WHERE id_user = '$id_user'";
			if ($koneksi->query($query)===TRUE) {
				// Jika Sukses, Lakukan :
				header("location: ../../page/user.php?pesan=edit", true, 301); // Redirect ke halaman produk.php
			}else{
				// Jika Gagal, Lakukan :
				header("location: ../../page/user.php?pesan=gagal", true, 301);
			}	
		}

	}elseif (empty($password)) {
		if ($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png" AND $ukuran_gambar < 5242880) {
			// Lakukan proses update termasuk mengganti foto sebelumnya
			$fotobaru = date('dmYHis').$gambar;// Rename nama fotonya dengan menambahkan tanggal dan jam upload
			// Set path folder tempat menyimpan fotonya
			$path = "../../assets/gambar/profil/".$fotobaru;

			if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
				// Query untuk menampilkan data gambar berdasarkan ID yang dikirim
				$query = "SELECT gambar FROM user WHERE id_user='$id_user'";
				$data = $koneksi->query($query);
				$tmp = $data->fetch_object();
				// Jika foto ada
				if(is_file("../../assets/gambar/profil/".$tmp->gambar))
				unlink("../../assets/gambar/profil/".$tmp->gambar); // Hapus file foto sebelumnya yang ada di folder images
				// Proses ubah data ke Database
				$query_dua = "UPDATE user SET username = '$username', level='$level', status_user = '$status_user', gambar='$fotobaru' WHERE id_user='$id_user'";
				if($koneksi->query($query_dua)===TRUE){ // Cek jika proses simpan ke database sukses atau tidak
					// Jika Sukses, Lakukan :
					header("location: ../../page/user.php?pesan=edit", true, 301); // Redirect ke halaman index.php
				}else{
					// Jika Gagal, Lakukan :
					header("location: ../../page/user.php?pesan=error", true, 301);
				}
			}else{
				// Jika gambar gagal diupload, Lakukan :
				header("location: ../../page/user.php?pesan=gagal", true, 301);
			}
		}else{
			// Jika gambar gagal diupload, Lakukan :
			header("location: ../../page/user.php?pesan=max", true, 301);
		}
	}
	else{ // Jika user memilih foto / mengisi input file foto pada form
		if ($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png" AND $ukuran_gambar < 5242880) {
			// Lakukan proses update termasuk mengganti foto sebelumnya
			$fotobaru = date('dmYHis').$gambar;// Rename nama fotonya dengan menambahkan tanggal dan jam upload
			// Set path folder tempat menyimpan fotonya
			$path = "../../assets/gambar/profil/".$fotobaru;

			if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
				// Query untuk menampilkan data gambar berdasarkan ID yang dikirim
				$query = "SELECT gambar FROM user WHERE id_user='$id_user'";
				$data = $koneksi->query($query);
				$tmp = $data->fetch_object();
				// Jika foto ada
				if(is_file("../../assets/gambar/profil/".$tmp->gambar))
				unlink("../../assets/gambar/profil/".$tmp->gambar); // Hapus file foto sebelumnya yang ada di folder images
				// Proses ubah data ke Database
				$query_dua = "UPDATE user SET username = '$username', password='$password', level='$level', status_user = '$status_user', gambar='$fotobaru' WHERE id_user='$id_user'";
				if($koneksi->query($query_dua)===TRUE){ // Cek jika proses simpan ke database sukses atau tidak
					// Jika Sukses, Lakukan :
					header("location: ../../page/user.php?pesan=edit", true, 301); // Redirect ke halaman index.php
				}else{
					// Jika Gagal, Lakukan :
					header("location: ../../page/user.php?pesan=error", true, 301);
				}
			}else{
				// Jika gambar gagal diupload, Lakukan :
				header("location: ../../page/user.php?pesan=gagal", true, 301);
			}
		}else{
			// Jika gambar gagal diupload, Lakukan :
			header("location: ../../page/user.php?pesan=max", true, 301);
		}
	}
}


 ?>

