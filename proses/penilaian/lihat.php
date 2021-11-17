<?php

include '../../koneksi.php';

$id_kategori = $_POST["id_kategori"];


if(!empty($id_kategori)){
	$id=intval($id_kategori);

	if(!is_numeric($id)){
	 	echo "invalid Floorid";
	}
	 else{ 
    $query = $koneksi->query("SELECT * FROM produk WHERE produk.`id_produk` NOT IN(SELECT id_produk FROM nilai_produk) AND id_kategori=$id_kategori");
	 ?>

   			<label for="produk">Nama Produk</label>
                <select name="produk" id="produk" class="form-control" style="font-size:14px; height: 44px" required autocomplete="off">
                  <option  selected disabled>- Pilih Produk -</option>
                
               
          		<?php
          		while($data = mysqli_fetch_assoc($query)){ 
          		?>
          		 	<option value="<?php echo $data['id_produk']; ?>"><?php echo $data['nama_produk']; ?></option>


          		  <?php }?>
          		</select>
          		<?php 
                  $query = "SELECT bobot_kriteria.*, kriteria.* FROM bobot_kriteria
                            INNER JOIN kategori ON kategori.`id_kategori` = bobot_kriteria.`id_kategori`
                            INNER JOIN kriteria ON kriteria.`id_kriteria` = bobot_kriteria.`id_kriteria`
                            WHERE bobot_kriteria.`id_kategori` = $id_kategori";
                  $data = mysqli_query($koneksi, $query);
                  foreach ($data as $data) {
                ?>
                  <input type="hidden" name="kriteria[]" value="<?php echo $data['id_kriteria'] ?>">
                  <label style="padding-top: 20px;" type="text"><?php echo $data['nama_kriteria'] ?></label>
                  <br>
                    <select class="form-control" name="nilai_kriteria[]" style="font-size:14px; height: 44px" required autocomplete="off">
                    <option value="-1">- Pilih Bobot -<?php echo $data['nama_kriteria'] ?></option>";
                        <?php $query_dua = "SELECT * FROM nilai_kriteria WHERE id_kriteria = $data[id_kriteria] ORDER BY nilai_kriteria.`nilai` ASC";
                        $data_dua = mysqli_query($koneksi, $query_dua);
                        foreach ($data_dua as $data_dua) {?>
                           <option value="<?= $data_dua['id_nilai_kriteria'] ?>"><?php echo $data_dua['keterangan'] ?></option>";
                          <?php
                          }
                        ?>
                  </select>
                <?php } ?>

                <div class="padding-tb td-center">
                    <button type="submit" id="buttonsimpan">Simpan</button>
                </div>
	<?php }

}
?>