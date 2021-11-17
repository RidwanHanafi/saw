<?php

require '../../koneksi.php';

//kondisi post new_pass
if(isset($_POST['password'])){

    $email = $_POST['email'];

    //dengan md5 encripsi
    $pass = md5($_POST['password']);
    $code = $_POST['code'];

    // print_r($pass);echo '<br>';
    // print_r($code);echo '<br>';

    // print_r($email);

    $query =    "UPDATE user
                SET password = '$pass'
                WHERE email = '$email'";

    $query_dua = "DELETE FROM reset_pw WHERE email = '$email'";



    if($koneksi->query($query) AND $koneksi->query($query_dua)===TRUE){

    	
        header("location: ../../index.php?pesan=npass");

    }else{

	    $result='failed'.$koneksi->error;

	}

    
}else{
    echo "hellow";
}

 ?>