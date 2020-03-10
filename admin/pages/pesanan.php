<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Data Pesanan</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Pesanan</li>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <?php if(isset($_GET["pesanan_id"])): ?>
                    <?php include_once("pesanan/detail_pesanan.php") ?>
                <?php else: ?>
                    <div class="card-header">
                        <div class="col-md-6">
                            <h3 class="card-title">Tabel kelola pesanan pelanggan</h3>
                        </div>
                        <div class="col-md-6 float-right" align="right">
                            <!-- <button type="button" id="add_button" data-toggle="modal" data-target="#modal" class="btn btn-info btn-sm">Add</button> -->
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID Pesanan</th>
                                    <th>Nama Pembeli</th>
                                    <th>Status Pesanan</th>
                                    <th>No Telp</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<!-- JS Section -->
<?php include_once("partials/inc_js.php") ?>

<script>
$(document).ready(function(){

    var dataTable = $('#example1').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            "url":"<?= BASE_URL; ?>admin/pages/pesanan/fetch_data.php",
            "type":"POST"
        },
        "columnDefs":[
            {
                "targets":[0,1,2,3,4,5],
                "orderable":false
            },
        ],
    });

    $(document).on('click', '.info', function(){
        $("#modal").modal("show")
    });

    $(document).on('click', '.delete', function(){
        var id_pesanan = $(this).attr("id");
        if(confirm("Are you sure you want to delete this?")) {
            $.ajax({
                url:"<?= BASE_URL; ?>admin/pages/pesanan/proses_delete.php",
                method:"POST",
                data:{id_pesanan:id_pesanan},
                success:function(data) {
                    alert(data);
                    dataTable.ajax.reload();
                }
            });
        }
        else {
            return false; 
        }
    });
});
</script>