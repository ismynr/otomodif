<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Data Kategori</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Kategori</li>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-6">
                        <h3 class="card-title">Tabel kelola kategori barang</h3>
                    </div>
                    <div class="col-md-6 float-right" align="right">
                        <button type="button" id="add_button" data-toggle="modal" data-target="#modal" class="btn btn-info btn-sm">Add</button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th col="kategori">Kategori Barang</th>
                                <th>Status Barang</th>
                                <th width=15%>Aksi</th>
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
<?php include_once("kategori/modal.php") ?>
<?php include_once("partials/inc_js.php") ?>

<script>
$(document).ready(function(){

    $('#add_button').click(function(){
        $('#form')[0].reset();
        $('.modal-title').text("Tambah Kategori");
        $('#action').val("Add");
        $('#operation').val("Add");
    });

    var dataTable = $('#example1').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            "url":"<?= BASE_URL; ?>admin/pages/kategori/fetch_data.php",
            "type":"POST"
        },
        "columnDefs":[
            {
                "targets":[0,1,2],
                "orderable":false
            },
        ],
    });

    $(document).on('submit', '#form', function(event){
        event.preventDefault();
        var kategori = $('#kategori').val();
        var status = $('#status').val();

        if(kategori != '' && status != '') {
            $.ajax({
                url:"<?= BASE_URL; ?>admin/pages/kategori/proses_add_edit.php",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data) {
                    alert(data);
                    $('#form')[0].reset();
                    $('#modal').modal('hide');
                    dataTable.ajax.reload();
                }
            });
        }
        else {
            alert("Both Fields are Required");
        }
    });

    $(document).on('click', '.update', function(){
        var id_kat = $(this).attr("id");
        $.ajax({
            url:"<?= BASE_URL; ?>admin/pages/kategori/fetch_single.php",
            method:"POST",
            data:{id_kat:id_kat},
            dataType:"json",
            success:function(data) {
                $('#modal').modal('show');
                $('#kategori').val(data.kategori);
                $("input[name=status][value=" + data.status + "]").attr('checked', 'checked');

                $('.modal-title').text("Edit Kategori");
                $('#id_kategori').val(id_kat);
                $('#action').val("Edit");
                $('#operation').val("Edit");
            }
        })
    });

    $(document).on('click', '.delete', function(){
        var id_kat = $(this).attr("id");
        if(confirm("Are you sure you want to delete this?")) {
            $.ajax({
                url:"<?= BASE_URL; ?>admin/pages/kategori/proses_delete.php",
                method:"POST",
                data:{id_kat:id_kat},
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