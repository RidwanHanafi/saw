<?php 
session_start();
if(!empty($_SESSION['email']) AND !empty($_SESSION['pass'])){
require '../view/header.php';
require '../koneksi.php';
?>


<div class="container">
         <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container">
        <div class="section-title">
          <h2>Hasil</h2>
        </div>
            <div class="php-email-form">
              <div class="td-center">
                <label>Pilih Kategori</label>
              </div>
             <div class="container">
              <div class="row">
                <div class="col">
                  <!-- //////////// -->
                </div>
                <div class="col order-12">
                 <!-- ///////////// -->
                </div>
                <div class="col order-1">

                  <select class="form-control" id="kategori_tepung" onChange="kategori_tepung(this.value);"  name="kategori_tepung" style="font-size:14px; height: 44px">
                    <option disabled selected>- Pilih Kategori -</option>
                    <?php 
                    $query = "SELECT nilai_produk.*, kategori.`nama_kategori` FROM nilai_produk
                              INNER JOIN kategori ON kategori.`id_kategori`=nilai_produk.`id_kategori`
                              GROUP BY nilai_produk.`id_kategori`
                              ORDER BY nilai_produk.`id_nilai_produk` DESC";
                    $data = mysqli_query($koneksi, $query);
                    foreach ($data as $data) {?>
                      <option value="<?php echo $data['id_kategori'] ?>"><?php echo $data['nama_kategori'] ?></option>
                    <?php } ?>
                </select>

                </div>
              </div>
            </div>
                
            </div>
            <div id="hasil">
          
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