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
          <h2>Halaman Kriteria</h2>
          <ol>
            <li><a href="<?php echo base_url() ?>">Beranda</a></li>
            <li>Kriteria</li>
          </ol>
        </div>
        <?php 
            if(isset($_GET['pesan'])){
                if($_GET['pesan']=='tambah'){
                     echo '<div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Sukses!</strong> Data berhasil di tambah.
                        </div>';
                }else if($_GET['pesan']=='hapus'){
                     echo '<div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Sukses!</strong> Data berhasil di hapus.
                        </div>';
                }else if($_GET['pesan']=='edit'){
                     echo '<div class="alert alert-info alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Sukses!</strong> Data berhasil di ubah.
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
          <h2>Kriteria</h2>
          <p>Masukan Kriteria</p>
        </div>

        <div class="row">
          <!-- cek kondisi admin atau karyawan -->
          <?php if ($_SESSION['level']==1) {?>
          <div class="col-lg-4">
            <div class="d-flex flex-column justify-content-center php-email-form" data-aos="fade-right">
            <form id="form" method="POST" action="../proses/kriteria/tambah.php" role="form"  data-aos="fade-left">
                <div class="form-group">
                <input type="hidden" name="op" value="keterangan"> 
                  <div class="field">
                    <input  type="text" name="kriteria" id="kriteria" placeholder="Nama Kriteria" required oninvalid="this.setCustomValidity('Masukan Nama Kriteria!')" oninput="setCustomValidity('')">
                    <label for="kriteria" style="font-size: 10px">Nama Kriteria</label>
                  </div>   
                
                <div class="validate"></div>

                <div class="padding-tb">
                <label>Sifat</label>
                <select class="form-control" id="sifat" name="sifat" style="font-size:14px; height: 44px">
                    <option value="Benefit">Benefit</option>
                    <option value="Cost">Cost</option>
                </select>
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
                        <th class="td-center" style="padding-left: 100px; padding-right: 100px">Kriteria</th>
                        <th class="td-center">Sifat</th>
                        <th class="td-center">Tool</th>
                    </tr>
                </thead>
                <?php 
                $query = "SELECT * FROM kriteria ORDER BY id_kriteria DESC";
                $data = mysqli_query($koneksi, $query);
                $no=1;
                ?>
                <tbody>
                    <?php foreach ($data as $data) { ?>
                    <tr >
                        <td class="td-center"><?php echo $no; ?></td>
                        <td class="td-center"><?php echo $data['nama_kriteria']; ?></td>
                        <td class="td-center"><?php echo $data['sifat']; ?></td>
                        <td class="td-center">
                            <?php require '../view/modal/modal_kriteria.php'; ?>
                            <?php if($_SESSION['level']==1){?>
                             <a href="<?php echo base_url() ?>proses/kriteria/hapus.php/?id=<?php echo $data['id_kriteria'] ?>" class="btn btn-danger" title="Jika dihapus maka data untuk penilaian juga ikut terhapus" onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fas fa-trash-alt"></i> Hapus</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php $no++; }?>
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