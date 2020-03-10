<div id="modal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
     <h4 class="modal-title">User</h4>
     <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
     <label>Nama</label>
     <input type="text" name="nama" id="nama" class="form-control" />
     <br />
     <label>Password</label>
     <div class="danger_password">
          <input type="text" name="password" id="password" class="form-control" />
     </div>
     <br />
     <label>Email</label>
     <input type="email" name="email" id="email" class="form-control" />
     <br />
     <label>Alamat</label>
     <textarea name="alamat" id="alamat" rows="5" class="form-control"></textarea>
     <br />
     <label>Nomer Telp</label>
     <input type="number" name="notelp" id="notelp" class="form-control" />
     <br />
     <label>Level</label> <br>
     <span>
		<input type="radio" name="level" value="SuperAdmin" /> Super Admin
		<input type="radio" name="level" value="Customer" /> Customer
	</span>
     <br /> <br>
     <label>Status</label> <br>
     <span>
		<input type="radio" name="status" value="Aktif" /> Aktif
		<input type="radio" name="status" value="Tidak" /> Tidak Aktif
	</span>
     <br />
    </div>
    <div class="modal-footer">
     <input type="hidden" name="id_user" id="id_user" />
     <input type="hidden" name="operation" id="operation" />

     <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div>
</div>