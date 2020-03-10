<div id="modal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
     <h4 class="modal-title">Kategori</h4>
     <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
     <label>Nama Kategori</label>
     <input type="text" name="kategori" id="kategori" class="form-control" />
     <br />
     <label>Status Kategori</label> <br>
     <span>
		<input type="radio" name="status" value="Publish" /> Publish
		<input type="radio" name="status" value="Unpublish" /> Unpublish
	</span>
     <br />
    </div>
    <div class="modal-footer">
     <input type="hidden" name="id_kategori" id="id_kategori" />
     <input type="hidden" name="operation" id="operation" />

     <input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div>
</div>