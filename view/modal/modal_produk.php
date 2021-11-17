<!-- Button trigger modal -->
<div data-toggle="modal" data-target="#myModal<?php echo $data['id_produk']; ?>" name="<?php echo $data['nama_produk'] ?>" class="button" id="button-7">
  <div id="dub-arrow"><img src="<?php echo base_url() ?>assets/icon/<?php echo $edit ?>.svg" alt=""></div>
  <a class="edit" href="#"><?php echo $edit ?></a>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $data['id_produk']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Nama Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label style="font-size: 23px"><?php echo $data['nama_produk'] ?></label><br>
        <?php if(empty($data['gambar_produk'])){ echo "<img class='g-produk' src='../assets/gambar/noimage.jpg' width='100' height='100'>"; }else{ echo "<img class='g-produk'  src='../assets/gambar/".$data['gambar_produk']."' >"; }  ?>
        <form role="form" action="<?php echo base_url() ?>proses/produk/edit.php" method="POST" enctype="multipart/form-data">
         <div class="form-group">
          <br>
          <label>Merk</label>
          <input type="hidden" name="id" value="<?php echo $data['id_produk'] ?>">
          <input type="text" name="nama" value="<?php echo $data['nama_produk']; ?>" class="form-control" required oninvalid="this.setCustomValidity('Masukkan Nama Produk!')" oninput="setCustomValidity('')">

          <?php 
          $query = "SELECT * FROM kategori" ;
          $datas = mysqli_query($koneksi, $query);
          ?>

          <label class="padding-t">Kategori</label>
          <select class="form-control"  name="id_kategori" style="font-size:14px; height: 44px" required oninvalid="this.setCustomValidity('Pilih Nama Kategori!')" oninput="setCustomValidity('')">
            <?php foreach ($datas as $datas) {?>
             <option value="<?php echo $datas['id_kategori'] ?>"<?php if($data['nama_kategori']==$datas['nama_kategori']){echo 'selected';} ?>><?php echo $datas['nama_kategori'] ?></option>
           <?php } ?>
         </select>

        <div class="padding-t">
          <label>Upload Gambar</label>
          <div class="custom-file padding-tb" style="font-size: 14px; height: 44px">
            <input type="file" class="custom-file-input" name="gambar_produk" title="Kosongkan jika tidak ingin mengubah gambar produk">
            <label class="custom-file-label" for="customFile">Pilih Gambar</label>
          </div>
        </div>

      </div>
      <div class="modal-footer">  
        <button type="submit" class="btn btn-success" <?php echo $disabled ?>>Simpan</button>
        <button type="button" class="btn btn-default"  data-dismiss="modal">Tutup</button>
      </div>
    </form>
    
  </div>
</div>
</div>
</div>

