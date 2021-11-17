<?php
$koneksi=new mysqli('localhost','morowali_esthree','b7fp{=?eYZRt','morowali_esthree');
if ($koneksi->connect_errno){
    "Database Error".$koneksi->connect_error;
}
?>