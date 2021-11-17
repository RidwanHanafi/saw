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
          <h2>Halaman Produk</h2>
          <ol>
            <li><a href="<?php echo base_url() ?>">Beranda</a></li>
            <li>Produk</li>
          </ol>
        </div>
        <?php 
            if(isset($_GET['pesan'])){
                if($_GET['pesan']=='tambah'){
                     echo '<div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Sukses!</strong> data berhasil ditambah.
                        </div>';
                }else if($_GET['pesan']=='hapus'){
                     echo '<div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Sukses!</strong> data berhasil dihapus.
                        </div>';
                }else if($_GET['pesan']=='salah'){
                     echo '<div class="alert alert-info alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Error!</strong> terjadi kesalahan saat mencoba untuk menyimpan data ke database.
                        </div>';
                }else if($_GET['pesan']=='gagal'){
                     echo '<div class="alert alert-info alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Error!</strong> gambar gagal untuk diupload.
                        </div>';
                }else if($_GET['pesan']=='edit'){
                     echo '<div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Sukses!</strong> gambar berhasil untuk diupload.
                        </div>';
                }else if($_GET['pesan']=='nedit'){
                     echo '<div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Sukses!</strong> data berhasil diubah.
                        </div>';
                }else if($_GET['pesan']=='ngagal'){
                     echo '<div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Error!</strong> terjadi kesalahan saat mencoba untuk menyimpan data ke database.
                        </div>';
                }else if($_GET['pesan']=='max'){
                     echo '<div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Gagal!</strong> gambar yang diupload harus format png, jpg, jpeg dan ukuran < 5 MB.
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
          <h2>Produk</h2>
          <p>Masukkan Merk</p>
        </div>

        <div class="row">
          <!-- cek kondisi admin atau karyawan -->
          <?php if ($_SESSION['level']==1) {?>
          <div class="col-lg-4 ">
            <div class="d-flex flex-column justify-content-center php-email-form" data-aos="fade-right">
            <form id="form" method="POST" action="../proses/produk/tambah.php" role="form" enctype="multipart/form-data" data-aos="fade-left">
              <div class="padding-b">
                  <input type="hidden" name="op" value="produk">
      
                  <div class="field">
                    <input  type="text" name="produk" id="produk" placeholder="Merk Tepung" required oninvalid="this.setCustomValidity('Masukan Merk Tepung!')" oninput="setCustomValidity('')">
                    <label for="produk" style="font-size: 10px">Merk Tepung</label>
                  </div>
              </div>
              <div class="padding-tb">
                <?php 
                  $query = "SELECT * FROM kategori";
                  $data = mysqli_query($koneksi, $query);
                ?>
                <label>Kategori Tepung</label>
                <select class="form-control" id="sifat" name="id_kategori" style="font-size:14px; height: 44px" required oninvalid="this.setCustomValidity('Masukan Nama Kategori!')" oninput="setCustomValidity('')">
                  <?php foreach ($data as $data) {?>
                     <option value="<?php echo $data['id_kategori'] ?>"><?php echo $data['nama_kategori'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="padding-tb">
                <label>Upload Gambar</label>
                <div class="custom-file padding-tb">
                  <input type="file" class="custom-file-input" id="customFile" name="gambar_produk">
                  <label class="custom-file-label text-right" for="customFile">Pilih Gambar</label>
                </div>
              </div>

                <div class="validate"></div>
                <div class="padding-tb td-center">
                   <button class="btn btn-success" type="submit" id="buttonsimpan">Simpan</button>
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
                        <th class="td-center">Gambar</th>
                        <th class="td-center">Merk</th>
                        <th class="td-center">Kategori</th>
                        <th class="td-center">Tool</th>
                    </tr>
                </thead>
                <?php 
                $query = "SELECT produk.*, kategori.`nama_kategori` FROM produk
                          INNER JOIN kategori ON kategori.`id_kategori` = produk.`id_kategori` ORDER BY kategori.`id_kategori` DESC";
                $data = mysqli_query($koneksi, $query);
                $no=1;
                ?>
                <tbody>
                    <?php foreach ($data as $data) { ?>
                    <tr>
                        <td class="td-center"><?php echo $no++; ?></td>
                        <td class="td-center"><?php if(empty($data['gambar_produk'])){ echo "<img class='g-produk' src='../assets/gambar/noimage.jpg' width='100' height='100'>"; }else{ echo "<img class='g-produk'  src='../assets/gambar/".$data['gambar_produk']."' >"; }  ?></td>
                        <td class="td-center"><?php echo $data['nama_produk']; ?></td>
                        <td class="td-center"><?php echo $data['nama_kategori']; ?></td>
                        <td class="td-center">
                            <?php require '../view/modal/modal_produk.php'; ?>
                            <?php if($_SESSION['level']==1){?>
                            <a href="<?php echo base_url() ?>proses/produk/hapus.php/?id=<?php echo $data['id_produk'] ?>" class="btn btn-danger" onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fas fa-trash-alt"></i> Hapus</a>
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