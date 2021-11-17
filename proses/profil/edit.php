<?php 
require '../../koneksi.php';

$id_user = $_POST['id_user'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = md5($_POST['password']);

$gambar = @$_FILES['gambar']['name'];
$tmp = @$_FILES['gambar']['tmp_name'];
$jenis_gambar = @$_FILES['gambar']['type'];
$ukuran_gambar= @$_FILES['gambar']['size'];

$fotobaru = date('dmYHis').$gambar;
$path = "../../assets/gambar/profil/".$fotobaru;

// jika foto kosong 
if (empty($gambar)) {

  $query = "UPDATE user SET email='$email' , username='$username' , password='$password' WHERE email='$email'";

  if($koneksi->query($query)===TRUE){ // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    header("location: ../../page/profil.php?pesan=tambah", true, 301); // Redirect ke halaman index.php
  }else{
    // Jika Gagal, Lakukan :
    header("location: ../../page/profil.php?pesan=eror", true, 301);
  }

}else{
  if ($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png" AND $ukuran_gambar < 5242880) {
    // Proses upload
    if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
      $query = "SELECT gambar FROM user WHERE id_user='$id_user'";
      $data = $koneksi->query($query);
      $tmp = $data->fetch_object();
    // Jika foto ada
    if(is_file("../../assets/gambar/profil/".$tmp->gambar))
      unlink("../../assets/gambar/profil".$tmp->gambar);
      // Proses simpan ke Database
    	$query = "UPDATE user SET username='$username', password='$password', gambar='$fotobaru' WHERE id_user=$id_user";

      if($koneksi->query($query)===TRUE){ // Cek jika proses simpan ke database sukses atau tidak
        // Jika Sukses, Lakukan :
        header("location: ../../page/profil.php?pesan=tambah", true, 301); // Redirect ke halaman index.php
      }else{
        // Jika Gagal, Lakukan :
    	header("location: ../../page/profil.php?pesan=salah", true, 301);
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



?>