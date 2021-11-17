<?php 
require '../../koneksi.php';

$id = $_GET['id'];

// Query untuk menampilkan data siswa berdasarkan ID yang dikirim
$query = "SELECT gambar_produk FROM produk WHERE id_produk = '$id'";
$data = $koneksi->query($query); // Eksekusi query 
$tmp = $data->fetch_object();
// Cek apakah file fotonya ada di folder images
if(is_file("../../assets/gambar/".$tmp->gambar_produk)) // Jika foto ada
  unlink("../../assets/gambar/".$tmp->gambar_produk); // Hapus foto yang telah diupload dari folder images
// Query untuk menghapus data berdasarkan ID yang dikirim

//hapus isi tabel nilai_produk
$query = "DELETE FROM nilai_produk WHERE id_produk = $id";

//hapus isi tabel hasil
$query_dua = "DELETE FROM hasil WHERE id_produk = $id";

//haspu isi tabel produk
$query_tiga = "DELETE FROM produk WHERE id_produk = $id";

if($koneksi->query($query) AND $koneksi->query($query_dua) AND $koneksi->query($query_tiga) ===TRUE){ // Cek jika proses simpan ke database sukses atau tidak
  // Jika Sukses, Lakukan :
  header("location: ../../../page/produk.php?pesan=hapus", true, 301); // Redirect ke halaman produk.php
}else{
  // Jika Gagal, Lakukan :
  header("location: ../../../page/produk.php?pesan=gagal", true, 301);
}

?>