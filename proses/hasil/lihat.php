<?php
include '../../koneksi.php';
include '../../base_url.php';


$id_kategori = @$_POST["id_kategori"];

require '../saw.php';
$saw = new saw();




################HIDDEN###################


// NORMALISASI
foreach ($saw->produk($id_kategori) as $nama_produk) {
    $no=0;
    foreach ($saw->nilai($id_kategori, $nama_produk['id_produk']) as $key){
        $hasil = $saw->Normalisasi($saw->nilai_kriteria($key['id_kriteria'],$id_kategori), $key['sifat'], $key['nilai']);
        $hitungbobot[$nama_produk['id_produk']][$no] = $hasil * $saw->bobot($id_kategori, $key['id_kriteria']);
        $no++;
    }
}


//HASIL
foreach ($saw->produk($id_kategori) as $produk) {
    $no=0;$hasil=0;
    foreach ($hitungbobot[$produk['id_produk']] as $data) {
    // menjumlahkan 
        $hasil+=$data;
        $saw->simpan_hasil($id_kategori, $produk['id_produk'], $hasil);
      } 
}



################END HIDDEN###################



// menampilkan nama kategori
$eksekusi = $koneksi->query("SELECT kategori.`nama_kategori` FROM kategori INNER JOIN hasil ON hasil.`id_kategori` = kategori.`id_kategori` WHERE hasil.`id_kategori`=$id_kategori GROUP BY hasil.`id_kategori`");

// kondisi cek hasil paling tinggi
// $queryhasil     =   $koneksi->query("SELECT * FROM hasil WHERE hasil.`hasil` = (SELECT MAX(hasil.`hasil`) FROM hasil WHERE hasil.`id_kategori` = $id_kategori)");
$queryhasil     =   $koneksi->query("SELECT id_produk, hasil FROM hasil WHERE id_kategori =$id_kategori AND hasil=(SELECT MAX(hasil) FROM hasil WHERE id_kategori=$id_kategori)");

foreach ($queryhasil as $queryhasil) {
    $cek=$queryhasil['hasil'];
    $produk_max = $queryhasil['id_produk'];
}


//Masuk tabel riwayat
  $saw->riwayat($id_kategori, $produk_max, $cek);           
//end Masuk tabel riwayat
    
// -- HASIL KESIMPULAN --

?>
<!-- Scroll Smooth  -->
<style>
html {
  scroll-behavior: smooth;
}
</style>
<div class="container">
 <!-- ======= Pricing Section ======= -->
 <section id="pricing" class="pricing section-bg">
  <div class="container">

    <div class="section-title" data-aos="fade-up">
        <h1>Jadi hasil pemilihan tepung <?php foreach($eksekusi as $eksekusi){echo $eksekusi['nama_kategori'];}?></h1>
    </div>
  <!-- CARAUSEL (SLIDE) -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false" >
        <div class="carousel-inner">
        <?php foreach ($saw->hasil($id_kategori) as $data) {
                        // kondisi jika hasil sama maka menjadi rekomendasi
            if ($cek==$data['hasil']) {
               $active = 'active';
               $rekomendasi = '<span class="recommended-badge">Rekomendasi</span>';
            }else{
                $active ='';
                $rekomendasi='';
            }
        ?>
    <div class="carousel-item <?php echo $active ?>">
        <div class="d-flex justify-content-center">
            <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
                <div class="box recommended" data-aos="zoom-in">
                    <?php echo $rekomendasi ?>
                    <h3><?php echo $data['nama_produk'] ?></h3>
                    <?php  if (empty($data['gambar_produk'])) {?>
                        <img class="g-hasil" style="object-fit: cover;" src="../assets/gambar/noimage.jpg" >
                    <?php }else{ ?> 
                        <img class="g-hasil" src="../assets/gambar/<?php echo $data['gambar_produk']; ?>" width="150" height="150" onclick="zoom(this)">
                    <?php }  ?>
                    <ul>
                        <li></li>
                        <li>Dengan Nilai:</li>
                        <h3><?php echo round($data['hasil'],3); ?></h3>
                        <li></li>
                        <li></li>
                    </ul>
                    <div class="btn-wrap">
                        <a href="#detail" class="btn-buy">Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</div>
<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
</a>
</div>
<!--END CARAUSEL (SLIDE) -->

</div>
</section><!-- End Pricing Section -->
</div>


<!-- PERHITUNGAN -->
<!-- Matrik Keputusan -->
<div class="col-lg-16 mt-5 mt-lg-0" data-aos="fade-up" id="detail">
    <div class="php-email-form">
        <div class="container">
          <div class="row">
            <div class="col text-center" style="padding-bottom: 30px;">
              <h2>Detail</h2>
            </div>
          </div>
        </div>
        <h2 class="td-center">Matriks Keputusan</h2>
        <table id="matriks" class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th rowspan="2" class="td-center">Merk Tepung</th>
                    <th colspan="<?php echo count($saw->kriteria($id_kategori)) ?>" class="td-center">Kriteria</th>
                </tr>
                <tr>
                    <?php if (!empty($saw->kriteria($id_kategori))):
                         foreach ($saw->kriteria($id_kategori) as $nama_kriteria) { ?>
                      <th class="td-center"><?php echo $nama_kriteria ?></th>
                     <?php } ?>
                    <?php endif ?>
                    
                </tr>
            </thead>
            <tbody>
                  <?php foreach ($saw->produk($id_kategori) as $nama_produk) {?>
                    <tr class="h5">
                        <td value"<?php echo $nama_produk['id_produk'] ?>"><?php if(empty($nama_produk['gambar_produk'])){ echo "<img class='g-produk' style='margin-right:10px;' src='../assets/gambar/noimage.jpg' width='100' height='100'>"; }else{ echo "<img class='g-produk' style='margin-right:10px;' src='../assets/gambar/".$nama_produk['gambar_produk']."'>"; }  ?><?php echo $nama_produk['nama_produk']?></td>
                        <?php foreach ($saw->nilai($id_kategori, $nama_produk['id_produk']) as $key) { ?>
                           <td class="td-center"><?php echo $key['keterangan']; echo " ("; echo $key['nilai']; echo ")" ?></td>
                      <?php  } ?>
              </tr>
           <?php }
            ?>
            </tbody>
        </table>
        <h5 class="td-center">Ket: Jika ada bagian yang kosong, cek kembali apakah nilai produk sudah terisi semua.</h5>
    </div>
</div>

<!-- Normalisasi -->
<div class="col-lg-16 mt-5 mt-lg-0" data-aos="fade-up">
    <div class="php-email-form">
        <h2 class="td-center">Normalisasi</h2>
        <table id="normalisasi" class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr><?php 

                    ?>
                    <th rowspan="2" class="td-center">Merk Tepung</th>
                    <th colspan="<?php echo count($saw->kriteria($id_kategori)) ?>" class="td-center">Kriteria</th>
                </tr>
                <tr>
                    <?php if (!empty($saw->kriteria($id_kategori))):
                         foreach ($saw->kriteria($id_kategori) as $nama_kriteria) { ?>
                      <th class="td-center"><?php echo $nama_kriteria ?></th>
                     <?php } ?>
                    <?php endif ?>
                    
                </tr>
            </thead>
               
            <tbody>
                 <?php foreach ($saw->produk($id_kategori) as $nama_produk) {
                    $no=0;
                    ?>
                    <tr class="h5">
                        <td value"<?php echo $nama_produk['id_produk'] ?>"><?php if(empty($nama_produk['gambar_produk'])){ echo "<img class='g-produk' style='margin-right:10px;' src='../assets/gambar/noimage.jpg' width='100' height='100'>"; }else{ echo "<img class='g-produk' style='margin-right:10px;'  src='../assets/gambar/".$nama_produk['gambar_produk']."' onclick='zoom(this)'>"; }  ?><?php echo $nama_produk['nama_produk']?></td>
                        <?php foreach ($saw->nilai($id_kategori, $nama_produk['id_produk']) as $key) { ?>
                            <?php 
                              
                             $hasil=$saw->Normalisasi($saw->nilai_kriteria($key['id_kriteria'],$id_kategori),$key['sifat'],$key['nilai']);
                            ?>
                            <td class="td-center"><?php echo $hasil ?></td>
                            <?php
                            $hitungbobot[$nama_produk['id_produk']][$no]=$hasil*$saw->bobot($id_kategori, $key['id_kriteria']);
                            $no++; ?>
                      <?php  }; ?>
                    </tr>
                <?php }
            ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Hasil -->
<div class="col-lg-16 mt-5 mt-lg-0" data-aos="fade-up">
    <div class="php-email-form">
    <h2 class="td-center">Perangkingan</h2>
        <table id="perangkingan" class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr><?php 

                    ?>
                    <th rowspan="2" class="td-center">Merk Tepung</th>
                    <th colspan="<?php echo count($saw->kriteria($id_kategori)) ?>" style="text-align: center; vertical-align: middle;">Kriteria</th>
                    <th rowspan="2" class="td-center">Hasil</th>
                </tr>
                <tr>
                    <?php if (!empty($saw->kriteria($id_kategori))):
                         foreach ($saw->kriteria($id_kategori) as $nama_kriteria) { ?>
                      <th style="text-align: center; vertical-align: middle;"><?php echo $nama_kriteria ?></th>
                     <?php } ?>
                    <?php endif ?>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($saw->hasil($id_kategori) as $produk) {
                    $no=0;$hasil=0;
                    if ($produk_max==$produk['id_produk']) {
                        $color = 'class="font-weight-bold text-white h5" style="background-color:#7cc576;"';
                    }else{
                         $color = 'class="h5"';
                    }
                    ?>
                    <tr <?php echo $color ?>>
                        <td value"<?php echo $produk['id_produk'] ?>"><?php if(empty($produk['gambar_produk'])){ echo "<img class='g-produk' style='margin-right:10px;' src='../assets/gambar/noimage.jpg' width='100' height='100'>"; }else{ echo "<img class='g-produk' style='margin-right:10px;' src='../assets/gambar/".$produk['gambar_produk']."'  onclick='zoom(this)'>"; }  ?><?php echo $produk['nama_produk']?></td>
                        <?php 
                            foreach ($hitungbobot[$produk['id_produk']] as $data) {

                        ?>
                    <!-- menjumlahkan -->

                            <td class="td-center"><?php echo $data;
                            $hasil+=$data;?></td>

                         <?php
                         $saw->simpan_hasil($id_kategori, $produk['id_produk'], $hasil);?>
                        <?php } ?>
                         
                       <td class="td-center" ><?php echo $hasil; ?></td>

                    </tr>
                <?php }
            ?>             
            </tbody>
        </table>
    </div>
</div>
   <!-- DataTables -->
<script>
  $(function () {
    $("#matriks").DataTable({
      "responsive": true,
      "autoWidth": false,
      "lengthChange": false,
      "language": {
        "sSearch": "Cari",
        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
        "zeroRecords": "Data tidak ditemukan",
        "paginate": {
          'previous': 'Sebelumnya',
          'next': 'Selanjutnya'
        }
        }
    });
  });
  $(function () {
    $("#normalisasi").DataTable({
      "responsive": true,
      "autoWidth": false,
      "lengthChange": false,
      "language": {
        "sSearch": "Cari",
        "sSearch": "Cari",
        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
        "zeroRecords": "Data tidak ditemukan",
        "paginate": {
          'previous': 'Sebelumnya',
          'next': 'Selanjutnya'
        }
        }
    });
  });

</script>