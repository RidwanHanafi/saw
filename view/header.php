<?php 
require '../koneksi.php';
require '../base_url.php'; 

$email = $_SESSION['email'];
$query = "SELECT * FROM user WHERE email='$email'";
$data = $koneksi->query($query);

foreach ($data as $data_user) {
  $username = $data_user['username'];
  $gambar   = $data_user['gambar'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pemilihan Tepung</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url() ?>assets/icon/logo1.png" rel="icon">
  <link href="<?php echo base_url() ?>assets/icon/logo1.png" rel="apple-touch-icon">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url() ?>assets/beranda/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/beranda/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/beranda/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/beranda/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/beranda/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/beranda/assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url() ?>assets/beranda/assets/css/style.css" rel="stylesheet">
  <!-- Custom css ku -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/custom/customku.css">
  <!-- DataTables -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/beranda/assets/js/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/beranda/assets/js/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<!--   <script>
   $(document).ready(function() {
    $('#myTable').DataTable();
    } );
    </script> -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container">

      <!-- The main logo is shown in mobile version only. The centered nav-logo in nav menu is displayed in desktop view  -->
      <div class="logo d-block d-lg-none">
        <a href="<?php echo base_url() ?>assets/beranda/index.html"><img src="<?php echo base_url() ?>assets/icon/logo1.png" alt="" class="img-fluid"></a>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul class="nav-inner">
          <li class="nav-logo"><a href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>assets/icon/logo1.png" alt="" class="img-fluid"></a></li>
          
          <?php 
            if($_SESSION['level']==1){
            ?>
          <li class="drop-down"><a>Beranda</a>
            <ul>
              <li><a href="<?php echo base_url() ?>">Info</a></li>
              <li><a href="<?php echo base_url() ?>page/user.php">User</a></li>
            </ul>
          </li>
        <?php }else{ ?>

          <li><a href="<?php echo base_url() ?>">Beranda</a></li>

        <?php } ?>
          <li><a href="<?php echo base_url() ?>page/kategori.php">Kategori</a></li>
          <li><a href="<?php echo base_url() ?>page/produk.php">Produk</a></li>
          <li class="drop-down"><a>Kriteria</a>
            <ul>
              <li><a href="<?php echo base_url() ?>page/kriteria.php">Kriteria</a></li>
              <li><a href="<?php echo base_url() ?>page/subkriteria.php">Sub Kriteria</a></li>
            </ul>
          </li>

          <li><a href="<?php echo base_url() ?>page/bobot.php">Bobot</a></li>
          <li><a href="<?php echo base_url() ?>page/penilaian.php">Nilai Produk</a></li>
          <li><a href="<?php echo base_url() ?>page/hasil.php">Hasil</a></li>
          <li class="drop-down"><a><?php if(empty($gambar)){ echo "<img class='icon-profil rounded-circle' src='../assets/gambar/noimage.jpg' width='50' height='50'>"; }else{ echo "<img class='icon-profil rounded-circle'  src='../assets/gambar/profil/".$gambar."' >"; }  ?></a>
            <ul>
              <li><a href="<?php echo base_url() ?>page/profil.php"><?php echo $username ?></a></li>
              <li><a href="<?php echo base_url() ?>logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->
