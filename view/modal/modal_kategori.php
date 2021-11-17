<!-- Button trigger modal -->
<div data-toggle="modal" data-target="#myModal<?php echo $data['id_kategori']; ?>" name="<?php echo $data['nama_kategori'] ?>" class="button" id="button-7">
<div id="dub-arrow"><img src="<?php echo base_url() ?>assets/icon/<?php echo $edit ?>.svg" alt=""></div>
  <a class="edit" href="#"><?php echo $edit ?></a>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $data['id_kategori']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Nama Kategori Tepung</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" action="<?php echo base_url() ?>proses/kategori/edit.php" method="POST">
			<div class="form-group">
				<label>Kategori</label>
					<input type="hidden" name="id" value="<?php echo $data['id_kategori'] ?>">
					<input type="text" name="nama" value="<?php echo $data['nama_kategori']; ?>" class="form-control" required oninvalid="this.setCustomValidity('Masukan Nama Kategori!')" oninput="setCustomValidity('')">      
			</div>
			<div class="modal-footer">  
				<button type="submit" class="btn btn-success" <?php echo $disabled ?>>Simpan</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</form>
      </div>
    </div>
  </div>
</div>

