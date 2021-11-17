<!-- Button trigger modal -->
<div data-toggle="modal" data-target="#myModal<?php echo $data['id_user']; ?>" class="button" id="button-7">
	<div id="dub-arrow"><img src="<?php echo base_url() ?>assets/icon/ubah.svg" alt=""></div>
	<a class="edit" href="#">Ubah</a>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $data['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Update User <?php echo $data['username'] ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form" action="<?php echo base_url() ?>proses/user/edit.php" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<input type="hidden" name="id_user" value="<?php echo $data['id_user'] ?>">
						<?php if(empty($data['gambar'])){ echo "<img class='g-hasil' src='../assets/gambar/noimage.jpg'>"; }else{ echo "<img class='g-hasil'  src='../assets/gambar/profil/".$data['gambar']."' >"; }  ?><br>
						<label class="padding-t">Email</label>
						<input type="email" name="email" value="<?php echo $data['email']; ?>" class="form-control">
		                  <label class="padding-t">Upload Gambar</label>
		                  <div class="custom-file ">
		                    <input type="file" class="custom-file-input" name="gambar">
		                    <label class="custom-file-label text-right" for="customFile">Pilih Gambar</label>
		                  </div>
						<label class="padding-t">Username</label>
						<input type="text" name="username" value="<?php echo $data['username']; ?>" minlength="6" class="form-control">
						<label class="padding-t">Password</label>
						<input type="password" name="password" value="" class="form-control">
						<label class="padding-t">Hak Akses</label>
						<select class="form-control" name="level" style="font-size:14px; height: 44px" required autocomplete="off">
							<option value="1" <?php if($data['level']==1){ echo 'selected';} ?>>Admin</option>
							<option value="0" <?php if($data['level']==0){ echo 'selected';} ?>>Karyawan</option>
						</select>
						<label class="padding-t">Status</label>
						<select class="form-control" name="status_user" style="font-size:14px; height: 44px" required autocomplete="off">
							<option value="aktif" <?php if($data['status_user']=='aktif'){ echo 'selected';} ?>>Aktif</option>
							<option value="nonaktif" <?php if($data['status_user']=='nonaktif'){ echo 'selected';} ?>>Nonaktif</option>
						</select>
					</div>
					<div class="modal-footer">  
						<button type="submit" class="btn btn-success">Simpan</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

