<!-- Button trigger modal -->
<div data-toggle="modal" data-target="#myModal<?php echo $data['id_nilai_kriteria']; ?>" name="<?php echo $data['id_nilai_kriteria'] ?>" class="button" id="button-7">
	<div id="dub-arrow"><img src="<?php echo base_url() ?>assets/icon/<?php echo $edit ?>.svg" alt=""></div>
	<a class="edit" href="#"><?php echo $edit ?></a>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $data['id_nilai_kriteria']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ubah Sub Kriteria</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form" action="<?php echo base_url() ?>proses/subkriteria/edit.php" method="POST">
					<label style="font-size: 23px"><?php echo $data['nama_kriteria'] ?></label>
					<input type="hidden" name="id" value="<?php echo $data['id_nilai_kriteria'] ?>">
					<div class="form-group">
						<label style="padding-top: 20px">Nama Kriteria</label>
						<?php 
						$querys = "SELECT * FROM kriteria";
						$datas = mysqli_query($koneksi, $querys);
						?>
						<select class="form-control" name="kriteria" style="font-size:14px; height: 44px">
							<?php foreach ($datas as $datas) {
								if ($data['id_kriteria']==$datas['id_kriteria']) { ?>
									<option value="<?php echo $datas["id_kriteria"]?>" selected><?php echo $datas['nama_kriteria'] ?></option>
								<?php }else{ ?>
									<option value="<?php echo $datas['id_kriteria'] ?>"><?php echo $datas['nama_kriteria'] ?></option>
								<?php }} ?>
							</select>
							<label style="padding-top: 20px">Nilai</label>
							<select class="form-control" name="nilai" style="font-size:14px; height: 44px" required autocomplete="off">
								<option value="0.01" <?php if($data['nilai']==0){echo 'selected';} ?>>0 - Sangat Rendah</option>
								<option value="0.25" <?php if($data['nilai']==0.25){echo 'selected';} ?>>0.25 - Rendah</option>
								<option value="0.5" <?php if($data['nilai']==0.5){echo 'selected';} ?>>0.5 - Sedang</option>
								<option value="0.75" <?php if($data['nilai']==0.75){echo 'selected';} ?>>0.75 - Tinggi</option>
								<option value="1" <?php if($data['nilai']==1){echo 'selected';} ?>>1 - Sangat Tinggi</option>
							</select>
							<label style="padding-top: 20px">Keterangan</label>
							<input type="text" name="keterangan" value="<?php echo $data['keterangan']; ?>" class="form-control" required oninvalid="this.setCustomValidity('Masukkan Keterangan!')" oninput="setCustomValidity('')">
						</div>
						<div class="modal-footer">  
							<button type="submit" class="btn btn-success" <?php echo $disabled?>>Simpan</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

