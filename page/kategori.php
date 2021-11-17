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
          <h2>Halaman Kategori</h2>
          <ol>
            <li><a href="<?php echo base_url() ?>">Beranda</a></li>
            <li>Kategori</li>
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
                     echo '<div class="alert alert-warning alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Gagal!</strong> Data sudah ada.
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
          <h2>Kategori</h2>
          <p>Masukan Kategori Tepung</p>
        </div>

        <div class="row">
           <?php if ($_SESSION['level']==1) {?>
          <div class="col-lg-4">
            <div class="d-flex flex-column justify-content-center php-email-form" >
            <form id="form" method="POST" action="../proses/kategori/tambah.php" role="form" data-aos="fade-left">
                <div class="form-group">
                  <div class="field">
                    <input  type="text" name="kategori" id="kategori" placeholder="Nama Kategori" required oninvalid="this.setCustomValidity('Masukan Nama Kategori!')" oninput="setCustomValidity('')">
                    <label for="kategori" style="font-size: 10px">Nama Kategori</label>
                  </div>
                <div class="padding-tb td-center">
                 <button type="submit" id="buttonsimpan">Simpan</button> 
                </div>
              </div>
            </form>
            </div>
          </div>
          <?php } ?>


          <div <?php if ($_SESSION['level']==1) {?> class="col-lg-8 mt-5 mt-lg-0"<?php }else{?> class="col-lg mt-5 mt-lg-0"<?php } ?>>
            <div class="php-email-form">
                <table id="example1" class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th class="td-center">No</th>
                        <th class="td-center" style="padding-left: 100px; padding-right: 100px" name="kategori" id="kategori" >Kategori</th>
                        <th class="td-center">Tool</th>
                    </tr>
                </thead>
                <?php 
                $query = "SELECT * FROM kategori ORDER BY id_kategori DESC";
                $data = mysqli_query($koneksi, $query);
                $no=1;
                ?>
                <tbody>
                    <?php foreach ($data as $data) { ?>
                    <tr >
                        <td class="td-center"><?php echo $no++; ?></td>
                        <td class="td-center"><?php echo $data['nama_kategori']; ?></td>
                        <td class="td-center">
                            <?php require '../view/modal/modal_kategori.php'; ?>
                            <?php if($_SESSION['level']==1){?>
                             <a href="<?php echo base_url() ?>proses/kategori/hapus.php/?id=<?php echo $data['id_kategori'] ?>" class="btn btn-danger" onclick="return confirm('Anda yakin mau menghapus item ini ? Produk, bobot, hasil dan penilaian yang berhubungan dengan item ini akan dihapus')"><i class="fas fa-trash-alt"></i> Hapus</a>
                            <?php } ?>
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