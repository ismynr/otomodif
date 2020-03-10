<div id="modal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
     <h4 class="modal-title">Kategori</h4>
     <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
     <label>Kategori</label>
     <!-- <input type="text" name="kategori" id="kategori" class="form-control" /> -->
     <select class="form-control" name="id_kat" id="id_kat">
     <option value=''>Pilih Kategori</option>
     <?php
          $stmt = $connection->prepare("SELECT * FROM kategori WHERE remove=0 ORDER BY kategori ASC");
          $stmt->execute(); 
          $result = $stmt->fetchAll();
          foreach($result as $row){
               echo "<option value='$row[id_kat]'>$row[kategori]</option>";
          }
     ?>
     </select>
     <br />
     <label>Nama Barang</label> <br>
     <input type="text" class="form-control" name="nama_barang" id="nama_barang"/>
     <br />
     <label>Spesifikasi Barang</label>
	<textarea name="spesifikasi" id="spesifikasi" class="ckeditor"></textarea>
     <br />
     <label>Stok Barang</label>
     <input type="number" name="stok" id="stok" class="form-control" value="" />
     <br />
     <label>Harga Barang</label>
     <input type="number" name="harga" id="harga" class="form-control" value="" />
     <br />
     <label>Berat Barang</label>
     <input type="number" name="berat" id="berat" class="form-control" value="" />
     <br />
     <label>Gambar Barang</label><br>
	<span>
		<input type="file" name="gambar" id="gambar"/>
          <span id="user_uploaded_image"></span>
	</span>
     <br />
     <label>Status Barang</label><br>
	<span>
		<input type="radio" name="status" value="Ready" /> Ready
		<input type="radio" name="status" value="Tidak Ready"/> Tidak Ready
	</span>

    </div>
    <div class="modal-footer">
     <input type="hidden" name="id_barang" id="id_barang" />
     <input type="hidden" name="operation" id="operation" />

     <input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div>
</div>

<script>
	CKEDITOR.replace("spesifikasi");
</script>