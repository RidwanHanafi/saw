<?php
require 'koneksi.php';

$email=@$_POST['email'];
$pass=@md5($_POST['password']);

if (empty($email)){
    $result="Email tidak boleh kosong";
}elseif (empty($pass)){
    $result="Password Tidak boleh kosong";
}elseif (empty($email) && empty($pass)){
    $ressult="Username dan password tidak boleh kosong";
}else{
	//seleksi
    $data = mysqli_query($koneksi,"SELECT * FROM user WHERE email='$email' AND password='$pass' AND status_user='aktif'");
    $hasil = $data->fetch_array(); 
    //menghitung jumlah data yang ditemukan
   	if($data->num_rows > 0){
   		session_start();
            $_SESSION['email'] = $email;
            $_SESSION['pass'] = $pass;
            $_SESSION['level'] = $hasil['level'];
            header("location: index.php", true, 301);
   	}else{
   		header("location:index.php?pesan=gagal");
   	}
}
