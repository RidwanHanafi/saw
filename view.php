<!DOCTYPE html>
<html lang="en">
<?php 
$email = $_SESSION['email'];
$query = "SELECT * FROM user WHERE email='$email'";
$data = $koneksi->query($query);

foreach ($data as $data_user) {
  $username = $data_user['username'];
  $gambar   = $data_user['gambar'];
}
 ?>
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
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/custom/customku.css">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url() ?>assets/beranda/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Knight - v2.2.1
  * Template URL: https://bootstrapmade.com/knight-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/tabel/css/style.css">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container">

      <!-- The main logo is shown in mobile version only. The centered nav-logo in nav menu is displayed in desktop view  -->
      <div class="logo d-block d-lg-none">
        <a href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>assets/icon/logo1.png"  class="img-fluid"></a>
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
          <li class="drop-down"><a><?php if(empty($gambar)){ echo "<img class='icon-profil rounded-circle' src='assets/gambar/noimage.jpg'>"; }else{ echo "<img class='icon-profil rounded-circle'  src='assets/gambar/profil/".$gambar."' >"; }  ?></a>
            <ul>
              <li><a href="<?php echo base_url() ?>page/profil.php"><?php echo $username ?></a></li>
              <li><a href="<?php echo base_url() ?>logout.php">Logout</a></li>
            </ul>
          </li>

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
          <h1 style="font-weight: bold; width: 100%; text-align: center; padding-bottom: 20px">Informasi</h1>
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <!-- query menampilkan jumlah -->
          <?php 
            $query_kategori = "SELECT * FROM kategori";
            $data_kategori = $koneksi->query($query_kategori);

            $query_produk = "SELECT * FROM produk";
            $data_produk = $koneksi->query($query_produk);

            $query_kriteria = "SELECT * FROM kriteria";
            $data_kriteria = $koneksi->query($query_kriteria);

            $query_nilaikriteria= "SELECT * FROM nilai_kriteria";
            $data_nilaikriteria = $koneksi->query($query_nilaikriteria);


          ?>
          <div class="col-md-3">
            <a href="<?php echo base_url() ?>page/kategori.php">
              <div class="card-counter primary">
                <i class="fas fa-code-branch"></i>
                <span class="count-numbers"><?php echo $data_kategori->num_rows ?></span>
                <span class="count-name">Kategori</span>
              </div>
            </a>
          </div>

         
          <div class="col-md-3">
            <a href="<?php echo base_url() ?>page/produk.php">
              <div class="card-counter danger">
                <i class="fa fa-bread-slice"></i>
                <span class="count-numbers"><?php echo $data_produk->num_rows ?></span>
                <span class="count-name">Produk</span>
              </div>
            </a>
          </div>

          <div class="col-md-3">
            <a href="<?php echo base_url() ?>page/kriteria.php">
              <div class="card-counter success">
                <i class="fas fa-cube"></i>
                <span class="count-numbers"><?php echo $data_kriteria->num_rows ?></span>
                <span class="count-name">Kriteria</span>
              </div>
            </a>
          </div>

          <div class="col-md-3">
            <a href="<?php echo base_url() ?>page/subkriteria.php">  
              <div class="card-counter info">
                <i class="fas fa-cubes"></i>
                <span class="count-numbers"><?php echo $data_nilaikriteria->num_rows ?></span>
                <span class="count-name">Sub Kriteria</span>
              </div>
            </a>
          </div>

      </div>

      </div>
    </section><!-- End Breadcrumbs -->
 <section class="inner-page">
      <div class="container">
        <p>
          
    
        </p>
      </div>
    </section>
   <section class="inner-page"  style="display: none;">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 text-center mb-5">
            <h2 class="heading-section">Riwayat</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="table-wrap">
              <table class="table table-responsive-xl">
                <thead>
                  <tr>
                    <th>&nbsp;</th>
                    <th>Merk Tepung</th>
                    <th class="td-center">Kategori</th>
                    <th class="td-center">Nilai</th>
                  </tr>
                </thead>
                <tbody>
                 <?php 
                 $no=1;
                 $query = "SELECT * FROM riwayat ORDER BY tanggal LIMIT 4";
                 $data_riwayat = $koneksi->query($query);
                 foreach ($data_riwayat as $data_riwayat) { ?>
                  <tr class="alert td-center" role="alert">
                    <td>
                      <label class="checkbox-primary">
                        <?php echo $no++ ?>
                      </label>
                    </td>
                    <td class="d-flex align-items-center">
                      <?php if(empty($data_riwayat['gambar_produk'])){ echo "<img class='g-produk-riwayat' src='assets/gambar/noimage.jpg' width='100' height='100'>"; }else{ echo "<img class='g-produk-riwayat'  src='assets/gambar/".$data_riwayat['gambar_produk']."' >"; }  ?>
                      <div class="pl-3 email">
                        <span><?php echo $data_riwayat['nama_produk'] ?></span>
                        <span>Tanggal: <?php echo date('d-m-Y',strtotime( $data_riwayat['tanggal'])) ?></span>
                      </div>
                    </td>
                    <td><?php echo $data_riwayat['nama_kategori'] ?></td>
                    <td class="status"><span class="active"><?php echo $data_riwayat['hasil'] ?></span></td>
                  </tr>
                   <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </section>

  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">

      <div class="container">

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <a href="<?php echo base_url() ?>index.php" class="scrollto footer-logo"><img src="<?php echo base_url() ?>assets/icon/logo1.png" alt=""></a>
            <h3>Esthree Cake and Bakery</h3>
            <p>Pemilihan tepung </p>
          </div>
        </div>
      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Esthree Cake</span></strong>.
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="<?php echo base_url() ?>assets/beranda/#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo base_url() ?>assets/beranda/assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/beranda/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url() ?>assets/beranda/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url() ?>assets/beranda/assets/vendor/php-email-form/validate.js"></script>
  <script src="<?php echo base_url() ?>assets/beranda/assets/vendor/jquery-sticky/jquery.sticky.js"></script>
  <script src="<?php echo base_url() ?>assets/beranda/assets/vendor/venobox/venobox.min.js"></script>
  <script src="<?php echo base_url() ?>assets/beranda/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url() ?>assets/beranda/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url() ?>assets/beranda/assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url() ?>assets/beranda/assets/js/main.js"></script>

   <!-- tabel -->
  <script src="<?php echo base_url() ?>assets/tabel/js/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/tabel/js/popper.js"></script>
  <script src="<?php echo base_url() ?>assets/tabel/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>assets/tabel/js/main.js"></script>
</body>

</html>