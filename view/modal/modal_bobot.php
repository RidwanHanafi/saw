<!-- Button trigger modal -->
<div data-toggle="modal" data-target="#myModal<?php echo $data['id_bobot_kriteria']; ?>" name="<?php echo $data['id_bobot_kriteria'] ?>" class="button" id="button-7">
<div id="dub-arrow"><img src="<?php echo base_url() ?>assets/icon/<?php echo $edit; ?>.svg" alt=""></div>
	<a class="edit" href="#"><?php echo $edit; ?></a>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $data['id_bobot_kriteria']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Bobot</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label style="font-size: 23px"><?php echo $data['nama_kategori'] ?></label>
        <form role="form" action="<?php echo base_url() ?>proses/bobot/edit.php" method="POST">
			   <div class="form-group">
          <input type="hidden" name="id_bobot_kriteria" value="<?php echo $data['id_bobot_kriteria'] ?>">
          <input type="hidden" name="id_kategori" value="<?php echo $data['id_kategori'] ?>">
            <br>
            <?php 
            $id_kategori = $data['id_kategori'];
            // $id_kriteria = $data['id_kriteria'];
           //query join tabel kriteria dan nilai kriteria
            $query = "SELECT bobot_kriteria.*, kriteria.`nama_kriteria`
                      FROM bobot_kriteria 
                      INNER JOIN kategori ON kategori.`id_kategori`= bobot_kriteria.`id_kategori`
                      INNER JOIN kriteria ON kriteria.`id_kriteria`= bobot_kriteria.`id_kriteria` WHERE bobot_kriteria.`id_kategori` = $id_kategori";

            $data = mysqli_query($koneksi, $query);
          ?>
            <?php foreach ($data as $data) { 
           ?>
            <input type="hidden" name="id_kriteria[]" value="<?php echo $data['id_kriteria'] ?>">
            <div class="padding-tb">
              <label><?php echo $data['nama_kriteria']?></label>
              <select class="form-control" name="nilai[]" style="font-size:14px; height: 44px">
                  <option value="">- Pilih Bobot -</option>
                  <option value="0.01" <?php if($data['bobot']==0.01){echo 'selected';} ?>>0 - Sangat Rendah</option>
                  <option value="0.25" <?php if($data['bobot']==0.25){echo 'selected';} ?>>0.25 - Rendah</option>
                  <option value="0.5" <?php if($data['bobot']==0.5){echo 'selected';} ?>>0.5 - Sedang</option>
                  <option value="0.75" <?php if($data['bobot']==0.75){echo 'selected';} ?>>0.75 - Tinggi</option>
                  <option value="1" <?php if($data['bobot']==1){echo 'selected';} ?>>1 - Sangat Tinggi</option>
            </select>
          </div>
          <?php 
            }
            ?>

           <?php 
            $query = $koneksi->query("SELECT kriteria.* FROM kriteria WHERE kriteria.`id_kriteria` NOT IN (SELECT bobot_kriteria.`id_kriteria` FROM bobot_kriteria INNER JOIN kategori ON kategori.`id_kategori` = bobot_kriteria.`id_kategori` WHERE kategori.`id_kategori`=$id_kategori)");
            foreach ($query as $kriteria_tambah) { 
            ?>
            <input type="hidden" name="id_kriteria_plus[]" value="<?php echo $kriteria_tambah['id_kriteria'] ?>">
            <div class="padding-tb">
              <label><?php echo $kriteria_tambah['nama_kriteria']?></label>
              <select class="form-control" name="nilai_plus[]" style="font-size:14px; height: 44px">
                  <option value="">- Pilih Bobot -</option>
                  <option value="0.01">0 - Sangat Rendah</option>
                  <option value="0.25">0.25 - Rendah</option>
                  <option value="0.5">0.5 - Sedang</option>
                  <option value="0.75">0.75 - Tinggi</option>
                  <option value="1">1 - Sangat Tinggi</option>
            </select>
          </div>
   
            <?php } ?>
			</div>
    			<div class="modal-footer">  
    				<button type="submit" class="btn btn-success" <?php echo $disabled; ?> >Simpan</button>
    				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
    			</div>
		    </form>
      </div>
    </div>
  </div>
</div>

