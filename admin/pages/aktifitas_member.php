<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Aktifitas</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Aktifitas</li>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th col="kategori">Nama User</th>
                                <th>Ip Address</th>
                                <th>Action</th>
                                <th>Item</th>
                                <th width=18%>Time</th>
                                <th width=5%>Info</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<!-- JS Section -->
<?php include_once("aktifitas_member/modal.php") ?>
<?php include_once("partials/inc_js.php") ?>

<script>
$(document).ready(function(){

    $(document).on('click', '.info', function(){
        var id = $(this).attr("id");
        $.ajax({
            url:"<?= BASE_URL; ?>admin/pages/aktifitas_member/get_aktifitas.php",
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function(data) {
                $('#modal').modal('show');
                $('#dt1').text(data.id_user);
                $('#dt2').text(data.ip_address);
                $('#dt3').text(data.item);
                $('#dt4').text(data.process);
                $('#dt5').text(data.time);
            }, error: function(xhr, status, error){
                alert(xhr.responseText);
            }
        })
    });

    var dataTable = $('#example1').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            "url":"<?= BASE_URL; ?>admin/pages/aktifitas_member/fetch_data.php",
            "type":"POST"
        },
        "columnDefs":[
            {
                "targets":[0,1,2,3,4],
                "orderable":false
            },
        ],
    });
});
</script>