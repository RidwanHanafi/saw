<?php
session_start();
if(!empty($_SESSION['email']) AND !empty($_SESSION['pass'])){
require '../view/header.php';
require '../koneksi.php';

$email = $_SESSION['email'];
$query = "SELECT * FROM user WHERE email='$email'";
$data = $koneksi->query($query);

?>
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
  <div class="container">
      
    <div class="d-flex justify-content-between align-items-center">
      <h2>Halaman User</h2>
      <ol>
        <li><a href="<?php echo base_url() ?>">Beranda</a></li>
        <li>User</li>
      </ol>
    </div>
    <?php 
        if(isset($_GET['pesan'])){
                if($_GET['pesan']=='tambah'){
                     echo '<div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Berhasil!</strong> Data user berhasil di tambah.
                        </div>';
                }else if($_GET['pesan']=='hapus'){
                     echo '<div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Berhasil!</strong> Data user berhasil di hapus.
                        </div>';
                }else if($_GET['pesan']=='edit'){
                     echo '<div class="alert alert-info alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Berhasil!</strong> Data user berhasil di ubah.
                        </div>';
                }else if($_GET['pesan']=='gagal'){
                     echo '<div class="alert alert-info alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Error!</strong> terjadi kesalahan saat mencoba untuk menyimpan data ke database.
                        </div>';
                }else if($_GET['pesan']=='salah'){
                     echo '<div class="alert alert-info alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Berhasil!</strong> Email sudah terdaftar, gunakan email lain.
                        </div>';
                }else if($_GET['pesan']=='max'){
                     echo '<div class="alert alert-info alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Gagal!</strong> gambar yang diupload harus format png, jpg, jpeg dan ukuran < 5 MB.
                        </div>';
                }else if($_GET['pesan']=='min'){
                     echo '<div class="alert alert-info alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Gagal!</strong> password harus lebih dari 6 karakter.
                        </div>';
                }
            }
        ?>
  </div>
</section><!-- End Breadcrumbs -->
<?php foreach ($data as $data) { ?>
<!-- ======= Contact Section ======= -->
<section id="contact" class="contact section-bg">
  <div class="container">
    <div class="section-title">
      <h2>Hallo <?php echo $data['username']; ?></h2>
      <p>Ubah Profil?</p>
    </div>
    <div class="d-flex justify-content-center">
      <div class="col-lg-6 col-md-6 mt-4 mt-md-0">
        <div class=" php-email-form" data-aos="fade-right">
          <form action="../proses/user/edit.php" method="POST" role="form" id="form" enctype="multipart/form-data" data-aos="fade-left">
                  <input type="hidden" name="id_user" value="<?php echo $data['id_user'] ?>">
                <div class="form-group">
                  <div class="field">
                    <input  type="email" name="email" id="kategori" value="<?php echo $data['email'] ?>" readonly />
                    <label for="kategori" style="font-size: 10px">Username</label>
                  </div>
                </div>

               <div class="form-group">
                  <div class="field">
                    <input  type="text" name="username" id="kategori" value="<?php echo $data['username'] ?>" minlength="6" required oninvalid="this.setCustomValidity('Masukan Nama Pengguna minimal 6 karakter!')" oninput="setCustomValidity('')">
                    <label for="kategori" style="font-size: 10px">Username</label>
                  </div>
                </div>

                <div class="form-group">
                    <div class="row">
                      <div class="col">
                        <label>Password</label>
                      </div>
                      <div class="col text-right ">
                        <label><i class="fa fa-info-circle" aria-hidden="true" title="Kosongkan jika tidak ingin mengganti password" ></i></label>
                      </div>
                    </div>
                  <input type="password" name="password" class="form-control"  value="" />
                </div>

                <div class="form-group">
                  <label>Upload Gambar</label>
                  <div class="custom-file padding-tb">
                    <input type="file" class="custom-file-input" id="customFile" name="gambar">
                    <label class="custom-file-label text-right" for="customFile">Pilih Gambar</label>
                  </div>
                </div>

               <?php  } ?>
              <div class="text-center"><button type="submit" id="buttonsimpan">Simpan</button></div>
            </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
require'../view/footer.php';
}else if(!empty($_SESSION['email']) AND !empty($_SESSION['pass']) AND !empty($_SESSION['level']=='0')){
  header("location: ../logout.php?pesan=logout", true, 301);
}else{
  header("location: ../index.php?pesan=login", true, 301);
}
?>