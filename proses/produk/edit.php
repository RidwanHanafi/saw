<?php 
require '../../koneksi.php';

$id = @$_POST['id'];
$nama = @$_POST['nama'];
$id_kategori = @$_POST['id_kategori'];
// Ambil data foto yang dipilih dari form
$gambar = @$_FILES['gambar_produk']['name'];
$tmp = @$_FILES['gambar_produk']['tmp_name'];

// Cek apakah user ingin mengubah fotonya atau tidak
if($gambar==''){ // Jika user tidak memilih file foto pada form
  // Lakukan proses update tanpa mengubah fotonya
  // Proses ubah data ke Database
	$query = "UPDATE nilai_produk
			SET id_kategori = '$id_kategori'
			WHERE id_produk = '$id'";
	$query_dua = "UPDATE hasil
			SET id_kategori = '$id_kategori'
			WHERE id_produk = '$id'";

  	$query_tiga = "UPDATE produk
			SET nama_produk = '$nama', id_kategori = '$id_kategori'
			WHERE id_produk = '$id'";



 
  // Eksekusi / Jalankan query
  if($koneksi->query($query) AND $koneksi->query($query_dua) AND $koneksi->query($query_tiga) ===TRUE){ // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    header("location: ../../page/produk.php?pesan=nedit", true, 301); // Redirect ke halaman produk.php
  }else{
    // Jika Gagal, Lakukan :
    header("location: ../../page/produk.php?pesan=ngagal", true, 301);
  }
}else{ // Jika user memilih foto / mengisi input file foto pada form
  // Lakukan proses update termasuk mengganti foto sebelumnya
  // Rename nama fotonya dengan menambahkan tanggal dan jam upload
  $fotobaru = date('dmYHis').$gambar;
  // Set path folder tempat menyimpan fotonya
  $path = "../../assets/gambar/".$fotobaru;
  // Proses upload
  if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
    // Query untuk menampilkan data gambar berdasarkan ID yang dikirim
    $query = "SELECT gambar_produk FROM produk WHERE id_produk='$id'";
    $data = $koneksi->query($query);
    $tmp = $data->fetch_object();
    // Jika foto ada
    if(is_file("../../assets/gambar/".$tmp->gambar_produk))
      unlink("../../assets/gambar/".$tmp->gambar_produk); // Hapus file foto sebelumnya yang ada di folder images
    // Proses ubah data ke Database
    $query_dua = "UPDATE produk SET nama_produk = '$nama', id_kategori = '$id_kategori', gambar_produk='$fotobaru' WHERE id_produk='$id'";
    if($koneksi->query($query_dua)===TRUE){ // Cek jika proses simpan ke database sukses atau tidak
      // Jika Sukses, Lakukan :
      header("location: ../../page/produk.php?pesan=edit", true, 301); // Redirect ke halaman index.php
    }else{
      // Jika Gagal, Lakukan :
      header("location: ../../page/produk.php?pesan=error", true, 301);
    }
  }else{
    // Jika gambar gagal diupload, Lakukan :
   	header("location: ../../page/produk.php?pesan=gagal", true, 301);
  }
}

 ?>

