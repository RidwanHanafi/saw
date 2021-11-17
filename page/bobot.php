<?php 
session_start();
if(!empty($_SESSION['email']) AND !empty($_SESSION['pass'])){
  if($_SESSION['level']==1){
    $disabled = '';
    $edit = 'ubah';
    $required = 'required';
  }else{
    $disabled = 'disabled';
    $readonly = 'readonly';
    $edit = 'lihat'; //nama file icon
  } 
require '../view/header.php';
require '../koneksi.php';
?>
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
          
        <div class="d-flex justify-content-between align-items-center">
          <h2>Halaman Bobot</h2>
          <ol>
            <li><a href="<?php echo base_url() ?>">Beranda</a></li>
            <li>Bobot</li>
          </ol>
        </div>
        <?php 
            if(isset($_GET['pesan'])){
                if($_GET['pesan']=='tambah'){
                     echo '<div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Sukses!</strong> Data berhasil ditambah.
                        </div>';
                }else if($_GET['pesan']=='hapus'){
                     echo '<div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Sukses!</strong> Data berhasil dihapus.
                        </div>';
                }else if($_GET['pesan']=='edit'){
                     echo '<div class="alert alert-info alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Sukses!</strong> Data berhasil diubah.
                        </div>';
                }else if($_GET['pesan']=='sama'){
                     echo '<div class="alert alert-info alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Maaf!</strong> Data jenis tepung yang dimasukan harus berbeda.
                        </div>';
                }else if($_GET['pesan']=='kosong'){
                     echo '<div class="alert alert-info alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Maaf!</strong> Anda belum memilih satu pun bobot.
                        </div>';
                }else if($_GET['pesan']=='nol'){
                     echo '<div class="alert alert-info alert-dismissible">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Maaf!</strong> Data bobot tidak boleh kosong.
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
          <h2>Bobot</h2>
          <p>Masukan Bobot</p>
        </div>

        <div class="row">
          <!--  -->
          <?php if ($_SESSION['level']==1) {?>
          <div class="col-lg-4 ">
            <div class="d-flex flex-column justify-content-center php-email-form" data-aos="fade-right">
            <form id="form" method="POST" action="../proses/bobot/tambah.php" role="form"  data-aos="fade-left">
                <div class="form-group">
                <div style="padding-top: 20px">
                <label for="sifat">Jenis Kategori</label>

                <?php 
                  $query = "SELECT * FROM kategori WHERE kategori.`id_kategori` NOT IN(SELECT id_kategori FROM bobot_kriteria)";
                  $data = mysqli_query($koneksi, $query);
                ?>                  
                <select class="form-control" id="sifat" name="id_kategori" style="font-size:14px; height: 44px" title="Pilih kategori" required oninvalid="this.setCustomValidity('Masukan Nama Kategori!')" oninput="setCustomValidity('')">
                  <option value="" selected>- Pilih Kategori -</option>
                  <?php foreach ($data as $nama_kategori) {?>
                  <option value="<?php echo $nama_kategori['id_kategori'] ?>"><?php echo $nama_kategori['nama_kategori'] ?></option>
                  <?php } ?>
                </select>
                </div>

                <?php 
                
                  $query = "SELECT * FROM kriteria";
                  $data = mysqli_query($koneksi, $query);
                  foreach ($data as $data) {

                ?>
                  <input type="hidden" name="id_kriteria[]" value="<?php echo $data['id_kriteria'] ?>">
                  <label style="padding-top: 20px;" type="text"><?php echo $data['nama_kriteria'] ?></label>
                  <br>
                    <select class="form-control" name="nilai[]" style="font-size:14px; height: 44px" title="Pilih bobot kriteria <?php echo $data['nama_kriteria'] ?>" >
                    <option value="-1">- Pilih Bobot <?php echo $data['nama_kriteria'] ?> -</option>";
                        <option value="0.01">0 - Sangat Rendah</option>
                        <option value="0.25">0.25 - Rendah</option>
                        <option value="0.5">0.5 - Sedang</option>
                        <option value="0.75">0.75 - Tinggi</option>
                        <option value="1">1 - Sangat Tinggi</option>
                  </select>
                <?php } ?>

                  <div class="padding-tb td-center">
                  <button type="submit" id="buttonsimpan">Simpan</button>
                </div>
              </div>
            </form>
            </div>
          </div>
          <?php } ?>
          <!-- end cek admin atau karyawan -->

          <div <?php if ($_SESSION['level']==1) {?> class="col-lg-8 mt-5 mt-lg-0"<?php }else{?> class="col-lg mt-5 mt-lg-0"<?php } ?>>
            <div class="php-email-form">
                <table id="example1" class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th style="text-align: center; vertical-align: middle;">No</th>
                        <th style="text-align: center; vertical-align: middle; padding-left: 100px; padding-right: 100px" name="kriteria" id="kriteria" >Kategori</th>
                        <th style="text-align: center; vertical-align: middle;">Tool</th>
                    </tr>
                </thead>
               <?php 
                 //query join tabel kriteria dan nilai kriteria
                $query = "SELECT bobot_kriteria.*, kategori.`nama_kategori`, kriteria.`nama_kriteria`
                          FROM bobot_kriteria 
                          INNER JOIN kategori ON kategori.`id_kategori`= bobot_kriteria.`id_kategori`
                          INNER JOIN kriteria ON kriteria.`id_kriteria`= bobot_kriteria.`id_kriteria`
                          GROUP BY bobot_kriteria.`id_kategori`
                          ORDER BY bobot_kriteria.`id_bobot_kriteria` DESC
                          ";
                $data = mysqli_query($koneksi, $query);
                $no=1;
                ?>
                <tbody>
                    <?php 
                    foreach ($data as $data) { ?>
                    <tr>
                        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                        <td style="text-align: center; vertical-align: middle;"><?php echo $data['nama_kategori']; ?></td>
                        <td style="text-align: center; vertical-align: middle;">
                            <?php require '../view/modal/modal_bobot.php'; ?>
                            <!-- cek kondisi hak akses -->
                            <?php if($_SESSION['level']==1){?>
                               <a href="<?php echo base_url() ?>proses/bobot/hapus.php/?id=<?php echo $data['id_kategori'] ?>" class="btn btn-danger" onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fas fa-trash-alt"></i> Hapus</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php $no++;}?>
                </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->
      </div>
 <?php
require '../view/footer.php';
}else{
     header("location: ../index.php?pesan=login", true, 301);
}
?>