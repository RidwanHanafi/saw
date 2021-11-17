<?php
require 'koneksi.php';
require 'base_url.php';

session_start();
if (empty($_SESSION['email']) AND empty($_SESSION['pass'])){
    include 'login.php';
}else{
    include 'view.php';
}