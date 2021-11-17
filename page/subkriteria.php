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
require'../view/header.php';
require '../koneksi.php';
?>

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
          
        <div class="d-flex justify-content-between align-items-center">
          <h2>Halaman Sub Kriteria</h2>
          <ol>
            <li><a href="<?php echo base_url() ?>">Beranda</a></li>
            <li>Sub Kriteria</li>
          </ol>
        </div>
        <?php 
            if(isset($_GET['pesan'])){
                if($_GET['pesan']=='tambah'){
                     echo '<div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Berhasil!</strong> Data berhasil di tambah.
                        </div>';
                }else if($_GET['pesan']=='hapus'){
                     echo '<div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Berhasil!</strong> Data berhasil di hapus.
                        </div>';
                }else if($_GET['pesan']=='edit'){
                     echo '<div class="alert alert-info alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Berhasil!</strong> Data berhasil di ubah.
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
          <h2>Sub Kriteria</h2>
          <p>Masukan Sub Kriteria</p>
        </div>

        <div class="row">
          <!-- cek kondisi admin atau karyawan -->
          <?php if ($_SESSION['level']==1) {?>
          <div class="col-lg-4">
            <div class="d-flex flex-column justify-content-center php-email-form" data-aos="fade-right">
            <form id="form" method="POST" action="../proses/subkriteria/tambah.php" role="form"  data-aos="fade-left">
                <div class="form-group">
                    <label for="sifat">Kriteria</label>
                <input type="hidden" name="op" value="nilai">  

                <div class="padding-tb">
                <?php 
                  $query = "SELECT * FROM kriteria";
                  $data = mysqli_query($koneksi, $query);
                ?>                  
                <select class="form-control"  name="kriteria"  style="font-size:14px; height: 44px" required oninvalid="this.setCustomValidity('Pilih Kriteria!')" oninput="setCustomValidity('')">
                  <option selected value="">- Pilih Kriteria -</option>
                  <?php foreach ($data as $data) {?>
                     <option value="<?php echo $data['id_kriteria'] ?>"><?php echo $data['nama_kriteria'] ?></option>
                  <?php } ?>
                </select>
                </div>

              <div class="padding-tb">
               <label for="sifat">Bobot Kriteria</label>
                <select class="form-control"  name="nilai" style="font-size:14px; height: 44px" required oninvalid="this.setCustomValidity('Pilih Bobot!')" oninput="setCustomValidity('')">
                  <option selected value="">- Pilih Bobot -</option>
                   <option value="0.01">0 - Sangat Rendah</option>
                   <option value="0.25">0.25 - Rendah</option>
                   <option value="0.5">0.5 - Sedang</option>
                   <option value="0.75">0.75 - Tinggi</option>
                   <option value="1">1 - Sangat Tinggi</option>
                </select> 
              </div> 
              <div class="padding-tb">
                 <div class="field">
                    <input  type="text" name="keterangan" id="keterangan" placeholder="Keterangan" required oninvalid="this.setCustomValidity('Masukan Keterangan!')" oninput="setCustomValidity('')">
                    <label for="keterangan" style="font-size: 10px">Keterangan</label>
                  </div>
              </div>

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
                        <th class="td-center">No</th>
                        <th class="td-center">Kriteria</th>
                        <th class="td-center">Bobot</th>
                        <th class="td-center">Keterangan</th>
                        <th class="td-center">Tool</th>
                    </tr>
                </thead>
               <?php 
                 //query join tabel kriteria dan nilai kriteria
                $query = "SELECT kriteria.`nama_kriteria`, nilai_kriteria.*
                            FROM nilai_kriteria INNER JOIN kriteria ON kriteria.`id_kriteria`= nilai_kriteria.`id_kriteria`
                            ORDER BY kriteria.`nama_kriteria` ASC, nilai_kriteria.`nilai` ASC";
                $data = mysqli_query($koneksi, $query);
                $no=1;
                ?>
                <style type="text/css">
                  a.disabled {
                      pointer-events: none;
                      cursor: default;
                    }
                </style>
                <tbody>
                    <?php foreach ($data as $data) { ?>
                    <tr>
                        <td class="td-center"><?php echo $no++; ?></td>
                        <td class="td-center"><?php echo $data['nama_kriteria']; ?></td>
                        <td class="td-center"><?php echo $data['nilai']; ?></td>
                        <td class="td-center"><?php echo $data['keterangan']; ?></td>
                        <td class="td-center">
                            <?php require '../view/modal/modal_subkriteria.php'; ?>
                           
                            <?php if($_SESSION['level']==1){//cek user

                              //cek apakah kriteria sudah di pilih di penilaian produk, jika iya maka tidak bisa dihapus. karena sedang digunakan
                                $query = "SELECT * FROM nilai_kriteria WHERE nilai_kriteria.`id_nilai_kriteria`  IN(SELECT id_nilai_kriteria FROM nilai_produk)";
                                $eksekusi = $koneksi->query($query);
                                foreach ($eksekusi as $eksekusi) {
                                  $cek_id[] =$eksekusi['id_nilai_kriteria'];
                                }
                                $cari = in_array($data['id_nilai_kriteria'], $cek_id);
                                if ($cari) {
                          
                              ?>
                             <button href="#" class="btn btn-secondary" title="Data tidak bisa dihapus karena sedang digunakan untuk perhitungan" disabled><i class="fas fa-trash-alt"></i> Hapus</button>
                           <?php }else{ ?>
                              <a href="<?php echo base_url() ?>proses/subkriteria/hapus.php/?id=<?php echo $data['id_nilai_kriteria'] ?>" class="btn btn-danger" onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fas fa-trash-alt"></i> Hapus</a>
                        <?php 
                         }} 
                         ?>
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
}else{
     header("location: ../index.php?pesan=login", true, 301);
}
?>