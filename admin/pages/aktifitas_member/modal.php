<div id="modal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
     <h4 class="modal-title">Info Aktifitas</h4>
     <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <div class="container">
            <div class="row">
              <img src="<?= BASE_URL.'assets/img/activityLog.jpg'; ?>"  alt="Image Profile" style="width: 100px; border-radius: 50%;" class="mx-auto">
            </div>
            <div class="table-responsive-md mt-2">
              <table class="table table-sm table-borderless table-condensed" >
                <tbody>
                  <tr>
                    <td width="35%">Member</td>
                    <td><p id="dt1"></p></td>
                  </tr>
                  <tr>
                    <td width="35%">Ip Address</td>
                    <td><p id="dt2"></p></td>
                  </tr>
                  <tr>
                    <td width="35%">Item</td>
                    <td><p id="dt3"></p></td>
                  </tr>
                  <tr>
                    <td width="35%">Process</td>
                    <td><p id="dt4" class="text-success"></p></td>
                  </tr>
                  <tr>
                    <td width="35%">Time</td>
                    <td><p id="dt5"></p></td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div>
</div>