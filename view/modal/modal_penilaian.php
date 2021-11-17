<!-- Button trigger modal -->
<div data-toggle="modal" data-target="#myModal<?php echo $data['id_produk']; ?>" name="<?php echo $data['id_produk'] ?>" class="button" id="button-7">
	<div id="dub-arrow"><img src="<?php echo base_url() ?>assets/icon/edit.svg" alt=""></div>
	<a class="edit" href="#">Edit</a>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $data['id_produk']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ubah Penilaian</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form role="form" action="<?php echo base_url() ?>proses/penilaian/edit.php" method="POST">
					<div class="form-group">
						<label style="font-size: 23px"><?php echo $data['nama_produk'] ?></label><br>

						<?php if(empty($data['gambar_produk'])){ echo "<img class='g-produk' src='../assets/gambar/noimage.jpg' width='100' height='100'>"; }else{ echo "<img class='g-produk' style='object-fit: cover;' src='../assets/gambar/".$data['gambar_produk']."' width='100' height='100' onclick='zoom(this)'>"; }  ?>

						<input type="hidden" name="id_nilai_produk" value="<?php echo $data['id_nilai_produk'] ?>">
						<input type="hidden" name="id_produk" value="<?php echo $data['id_produk'] ?>">
						<input type="hidden" name="id_kategori" value="<?php echo $data['id_kategori'] ?>">
            			<input type="hidden" name="id_user" value="<?php echo $id_user ?>">

						<br>
						<br>
						<?php 
						$id_produk = $data['id_produk'];
						$id_kategori = $data['id_kategori'];

						$query  = "SELECT nilai_produk.*, produk.`nama_produk`, kriteria.`nama_kriteria`
						FROM nilai_produk
						INNER JOIN produk ON produk.`id_produk` = nilai_produk.`id_produk`
						INNER JOIN kriteria ON kriteria.`id_kriteria` = nilai_produk.`id_kriteria`
						WHERE nilai_produk.`id_produk` = $id_produk";
						
           
						$data = mysqli_query($koneksi, $query);

						foreach ($data as $data) {
              				//untuk selected
							$id_nilai_kriteria = $data['id_nilai_kriteria'];
							?>
							<label class="padding-tb"><?php echo $data['nama_kriteria'] ?></label>
							<input type="hidden" name="id_kriteria[]" value="<?php echo $data['id_kriteria'] ?>">
							<select class="form-control" name="id_nilai_kriteria[]" style="font-size:14px; height: 44px">
								<?php $query_dua = "SELECT * FROM nilai_kriteria WHERE id_kriteria = $data[id_kriteria] ORDER BY nilai ASC";
								$data_dua = mysqli_query($koneksi, $query_dua);
								foreach ($data_dua as $data_dua) {?>
									<option <?php if($id_nilai_kriteria === $data_dua['id_nilai_kriteria']){ echo 'selected';} ?> value="<?php echo $data_dua['id_nilai_kriteria'] ?>"><?php echo $data_dua['keterangan'] ?></option>
									<?php
								}
								?>
							</select>
						<?php } ?>
						
						<?php 
						$query_plus = "SELECT bobot_kriteria.*, kriteria.`nama_kriteria` FROM bobot_kriteria INNER JOIN kriteria ON kriteria.`id_kriteria` = bobot_kriteria.`id_kriteria`  WHERE bobot_kriteria.`id_kategori`=$id_kategori AND bobot_kriteria.`id_kriteria` NOT IN(SELECT nilai_produk.`id_kriteria` FROM nilai_produk WHERE nilai_produk.`id_kategori`='$id_kategori' AND nilai_produk.`id_produk`='$id_produk')";
						$data_plus = mysqli_query($koneksi, $query_plus);
						foreach ($data_plus as $data_plus) {
						?>
						<label class="padding-tb"><?php echo $data_plus['nama_kriteria'] ?></label>
							<input type="hidden" name="id_kriteria_plus[]" value="<?php echo $data_plus['id_kriteria'] ?>">
							<select class="form-control" name="id_nilai_kriteria_plus[]" style="font-size:14px; height: 44px">
								<?php $query_dua_plus = "SELECT * FROM nilai_kriteria WHERE id_kriteria = $data_plus[id_kriteria] ORDER BY nilai ASC";
								$data_dua_plus = mysqli_query($koneksi, $query_dua_plus); ?>
								<option selected disabled>- Pilih -</option>
								<?php foreach ($data_dua_plus as $data_dua_plus) {?>
									<option value="<?php echo $data_dua_plus['id_nilai_kriteria'] ?>"><?php echo $data_dua_plus['keterangan'] ?></option>
									<?php
								}
								?>
							</select>
						<?php } ?>
					</div>


					<?php 
					//cek last chage nilai produk
					$query_user = "SELECT nilai_produk.`id_user`, user.`username` FROM nilai_produk INNER JOIN user ON user.`id_user` = nilai_produk.`id_user` WHERE nilai_produk.`id_produk` ='$id_produk' AND nilai_produk.`id_kategori` = '$id_kategori' GROUP BY nilai_produk.`id_user`";
					$data_user = $koneksi->query($query_user);
					
					?>
					<div class="modal-footer"> 
						<?php foreach ($data_user as $data_user) {?>
							 <?php if($data_user['username']==null){ echo "<div class='mr-auto'><label>Perubahan terakhir oleh: -</label></div>"; }else{ echo "<div class='mr-auto'><label>Perubahan terakhir oleh: ".$data_user['username']."</label></div>";} ?>
						<?php
					} ?>
						
						<button type="submit" class="btn btn-success">Simpan</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

