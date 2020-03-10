<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Barang</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Barang</li>
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
                        <h3 class="card-title">Tabel kelola produk sparepart</h3>
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
                                <th>Nama Barang</th>
                                <th>Kategori Barang</th>
                                <th>Harga Barang</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Aksi</th>
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
<?php include_once("barang/modal.php") ?>
<?php include_once("partials/inc_js.php") ?>

<script>
$(document).ready(function(){

    $('#add_button').click(function(){
        $('#form')[0].reset();
        $('.modal-title').text("Tambah Produk");
        $('#action').val("Add");
        $('#operation').val("Add");
        $('#user_uploaded_image').html('');
    });

    var dataTable = $('#example1').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            "url":"<?= BASE_URL; ?>admin/pages/barang/fetch_data.php",
            "type":"POST"
        },
        "columnDefs":[
            {
                "targets":[0,1,2,3,4,5],
                "orderable":false
            },
        ],
    });

    $(document).on('submit', '#form', function(event){
        event.preventDefault();
        var kategori = $('#kategori').val();
        var nama_barang = $('#nama_barang').val();
        var spesifikasi = $('#spesifikasi').val();
        var stok = $('#stok').val();
        var harga = $('#harga').val();
        var berat = $('#berat').val();
        var status = $('#status').val();

        var gambar = $('#gambar').val().split('.').pop().toLowerCase();
        if(gambar != '') {
            if(jQuery.inArray(gambar, ['gif','png','jpg','jpeg']) == -1) {
                alert("Invalid Image File");
                $('#gambar').val('');
                return false;
            }
        } 

        if(kategori != '' && nama_barang != '' && spesifikasi != '' && stok != '' && harga != '' 
            && berat != ''  && status != '') {
            $.ajax({
                url:"<?= BASE_URL; ?>admin/pages/barang/proses_add_edit.php",
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
        var id_barang = $(this).attr("id");
        $.ajax({
            url:"<?= BASE_URL; ?>admin/pages/barang/fetch_single.php",
            method:"POST",
            data:{id_barang:id_barang},
            dataType:"json",
            success:function(data) {
                $('#modal').modal('show');
                $('#id_kat').val(data.id_kat);
                $('#nama_barang').val(data.nama_barang);
                CKEDITOR.instances.spesifikasi.setData(data.spesifikasi);
                $('#stok').val(data.stok);
                $('#harga').val(data.harga);
                $('#berat').val(data.berat);
                $("input[name=status][value=" + data.status + "]").attr('checked', 'checked');
                $('#user_uploaded_image').html(data.gambar);

                $('#id_barang').val(id_barang);
                $('.modal-title').text("Edit Produk");
                $('#action').val("Edit");
                $('#operation').val("Edit");
            }, error: function(xhr, status, error){
                alert(xhr.responseText);
            }
        })
    });

    $(document).on('click', '.delete', function(){
        var id_barang = $(this).attr("id");
        if(confirm("Are you sure you want to delete this?")) {
            $.ajax({
                url:"<?= BASE_URL; ?>admin/pages/barang/proses_delete.php",
                method:"POST",
                data:{id_barang:id_barang},
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