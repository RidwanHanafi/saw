<?php 
require '../../koneksi.php';

// $id = @$_POST['id'];
// $op = @$_POST['op'];
$produk       = @$_POST['produk'];
$id_kategori  = @$_POST['id_kategori'];
$gambar       = @$_FILES['gambar_produk']['name'];
$tmp          = @$_FILES['gambar_produk']['tmp_name'];
$jenis_gambar = @$_FILES['gambar_produk']['type'];
$ukuran_gambar= @$_FILES['gambar_produk']['size'];

$fotobaru = date('dmYHis').$gambar;
$path = "../../assets/gambar/".$fotobaru;

// jika foto kosong 
if (empty($gambar)) {

  $query = "INSERT INTO produk(nama_produk, id_kategori) VALUES('$produk','$id_kategori')";

  if($koneksi->query($query)===TRUE){ // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    header("location: ../../page/produk.php?pesan=tambah", true, 301); // Redirect ke halaman index.php
  }else{
    // Jika Gagal, Lakukan :
  header("location: ../../page/produk.php?pesan=salah", true, 301);
  }

} else{
   if ($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png" AND $ukuran_gambar < 5242880) {
     // Proses upload
      if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
        // Proses simpan ke Database
        $query = "INSERT INTO produk(nama_produk, id_kategori, gambar_produk) VALUES('$produk','$id_kategori','$fotobaru')";

        if($koneksi->query($query)===TRUE){ // Cek jika proses simpan ke database sukses atau tidak
          // Jika Sukses, Lakukan :
          header("location: ../../page/produk.php?pesan=tambah", true, 301); // Redirect ke halaman index.php
        }else{
          // Jika Gagal, Lakukan :
        header("location: ../../page/produk.php?pesan=salah", true, 301);
        }
      }else{
        // Jika gambar gagal diupload, Lakukan :
        header("location: ../../page/produk.php?pesan=gagal", true, 301);
        
      }
   }else{
    // Jika gambar gagal diupload, Lakukan :
        header("location: ../../page/produk.php?pesan=max", true, 301);
   }
  
}



?>

