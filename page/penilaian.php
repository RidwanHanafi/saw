<?php 
session_start();
if(!empty($_SESSION['email']) AND !empty($_SESSION['pass'])){

  require '../view/header.php';
  require '../koneksi.php';
  //cek id_user yang login
  $email=$_SESSION['email'];
  $query = "SELECT * FROM user WHERE email = '$email'";
  $data = $koneksi->query($query);
  foreach ($data as $data) {
    $id_user = $data['id_user'];
  }

  
?>
  <!-- ======= Breadcrumbs ======= -->
  <section class="breadcrumbs">
    <div class="container">
      
      <div class="d-flex justify-content-between align-items-center">
        <h2>Halaman Nilai Produk</h2>
        <ol>
          <li><a href="<?php echo base_url() ?>">Beranda</a></li>
          <li>Nilai Produk</li>
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
       }else if($_GET['pesan']=='sama'){
         echo '<div class="alert alert-info alert-dismissible">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Maaf !</strong> Data kategori tepung yang dimasukan sudah ada.
         </div>';
       }else if($_GET['pesan']=='kosong'){
         echo '<div class="alert alert-info alert-dismissible">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Maaf !</strong> Produk belum dipilih.
         </div>';
       }else if($_GET['pesan']=='nol'){
         echo '<div class="alert alert-info alert-dismissible">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Maaf !</strong> Data bobot tidak boleh kosong.
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
        <h2>Nilai PRoduk</h2>
        <p>Masukkan Penilaian</p>
      </div>

      <div class="row">
        <div class="col-lg-4">
          <div class="d-flex flex-column justify-content-center php-email-form" data-aos="fade-right">
            <form id="form" method="POST" action="../proses/penilaian/tambah.php" role="form"  data-aos="fade-left">
            <input type="hidden" name="id_user" value="<?php echo $id_user ?>">
              <div class="form-group">
                <?php 
                $query = "SELECT bobot_kriteria.*, kategori.`nama_kategori` FROM bobot_kriteria INNER JOIN kategori ON kategori.`id_kategori` = bobot_kriteria.`id_kategori` GROUP BY bobot_kriteria.`id_kategori`";
                $data = mysqli_query($koneksi, $query);
                ?> 
                <div class="padding-tb">
                  <label for="kategori">Nama Kategori</label>
                  <select name="kategori" id="kategori" onChange="getCat(this.value);" class="kategori form-control" style="font-size:14px; height: 44px" required autocomplete="off">
                    <option value=""selected disabled>- Pilih Kategori -</option>
                    <?php foreach ($data as $data) : ?>
                      <option value="<?= $data['id_kategori'] ?>"><?= $data['nama_kategori'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="padding-tb"></div>
                
                <div id="jenis_kriteria">
                  
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
                  <th class="td-center">Kategori</th>
                  <th class="td-center">Merk</th>
                  <th class="td-center">Gambar</th>
                  <th class="td-center">Tool</th>
                </tr>
              </thead>
              <?php 
                 //query join tabel kriteria dan nilai kriteria
              $query = "SELECT nilai_produk.*,kategori.*, produk.* FROM nilai_produk
              INNER JOIN kategori ON kategori.`id_kategori` = nilai_produk.`id_kategori`
              INNER JOIN produk ON produk.`id_produk` = nilai_produk.`id_produk`
              GROUP BY nilai_produk.`id_produk`
              ORDER BY kategori.`id_kategori` DESC
              ";
              $data = mysqli_query($koneksi, $query);
              $no=1;
              ?>
              <tbody>
                <?php foreach ($data as $data) { ?>
                  <tr>
                    <td class="td-center"><?php echo $no; $no++; ?></td>
                    <td class="td-center"><?php echo $data['nama_kategori']; ?></td>
                    <td class="td-center"><?php echo $data['nama_produk']; ?></td>
                    <td class="td-center"><?php if(empty($data['gambar_produk'])){ echo "<img class='g-produk' src='../assets/gambar/noimage.jpg' width='100' height='100'>"; }else{ echo "<img class='g-produk' style='object-fit: cover;' src='../assets/gambar/".$data['gambar_produk']."' width='100' height='100' onclick='zoom(this)'>"; }  ?></td>
                    <td class="td-center">
                      <?php require '../view/modal/modal_penilaian.php'; ?>
                      <a href="<?php echo base_url() ?>proses/penilaian/hapus.php/?id=<?php echo $data['id_produk'];?>" class="btn btn-danger" onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fas fa-trash-alt"></i> Hapus</a>
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