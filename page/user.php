<?php 
session_start();
if(!empty($_SESSION['email']) AND !empty($_SESSION['pass']) AND !empty($_SESSION['level']=='1')){
require '../view/header.php';
require '../koneksi.php';
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
      <div class="container">
         <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Users</h2>
          <p>Tambah User</p>
        </div>

        <div class="row">
          <div class="col-lg-4">
            <div class="d-flex flex-column justify-content-center php-email-form" data-aos="fade-right">
            <form id="form" method="POST" action="../proses/user/tambah.php" role="form" enctype="multipart/form-data"  data-aos="fade-left">
                <div class="form-group">
                 <div class="field">
                    <input  type="email" name="email" id="email" placeholder="Email" data-validate="Valid email is required: ex@abc.xyz" required oninvalid="this.setCustomValidity('Masukan Email!')" oninput="setCustomValidity('')">
                    <label for="email" style="font-size: 10px">Email</label>
                  </div>
                  <div class="field">
                    <input  type="text" name="username" id="username" placeholder="Username" required oninvalid="this.setCustomValidity('Masukan Username!')" oninput="setCustomValidity('')">
                    <label for="username" style="font-size: 10px">Username</label>
                  </div> 
                  <div class="field">
                    <input  type="password" name="password" id="password" placeholder="Password" required oninvalid="this.setCustomValidity('Masukan Password!')" oninput="setCustomValidity('')">
                    <label for="password" style="font-size: 10px">Password</label>
                  </div>   
                <label class="padding-t">Upload Gambar</label>
                  <div class="custom-file padding-tb">
                    <input type="file" class="custom-file-input" id="customFile" name="gambar">
                    <label class="custom-file-label text-right" for="customFile">Pilih Gambar</label>
                  </div>
                <label class="padding-t">Hak Akses</label>
                  <select type="password" class="form-control"name="level" placeholder="Hak Akses" style="font-size:14px; height: 44px" required autocomplete="off">
                    <option selected disabled>- Pilih -</option>
                    <option value="1">Admin</option>
                    <option value="0">Karyawan</option>
                  </select>
                <div class="validate"></div>
                <div class="padding-t">
                <button type="submit" id="buttonsimpan">Simpan</button>
                </div>
              </div>
            </form>
            </div>
          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">
            <div class="php-email-form">
                <table id="example1" class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th class="td-center">No</th>
                        <th class="td-center">Gambar</th>
                        <th class="td-center">Username</th>
                        <th class="td-center">Email</th>
                        <th class="td-center">Hak Akses</th>
                        <th class="td-center">Tool</th>
                    </tr>
                </thead>
                <?php 
                $query = "SELECT * FROM user ORDER BY status_user ASC, id_user DESC";
                $data = mysqli_query($koneksi, $query);
                $no=1;
                ?>
                <tbody>
                    <?php foreach ($data as $data) { 
                    ?>
                    <tr <?php if($data['status_user']=='nonaktif'){ echo 'style="background-color: #c9c9c9"'; } ?>>
                        <td class="td-center"><?php echo $no++; ?></td>
                        <td class="td-center"><?php if(empty($data['gambar'])){ echo "<img class='g-produk' src='../assets/gambar/noimage.jpg' width='100' height='100'>"; }else{ echo "<img class='g-produk'  src='../assets/gambar/profil/".$data['gambar']."' >"; }  ?></td>
                        <td class="td-center"><?php echo $data['username']; ?></td>
                        <td class="td-left-center"><?php echo $data['email']; ?></td>
                        <td class="td-center"><?php if($data['level']==1){ echo 'Admin'; }else{ echo 'Karyawan'; } ?></td>
                        <td class="td-center">
                            <?php require '../view/modal/modal_user.php'; ?>
                          
                           
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->
      </div>
 <?php
require'../view/footer.php';
}else if(!empty($_SESSION['email']) AND !empty($_SESSION['pass']) AND !empty($_SESSION['level']=='0')){
  header("location: ../logout.php?pesan=logout", true, 301);
}else{
  header("location: ../index.php?pesan=login", true, 301);
}
?>