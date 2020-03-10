<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Data Member</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Member</li>
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
                        <h3 class="card-title">Tabel kelola member</h3>
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
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Nomer Hp</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Action</th>
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
<?php include_once("kelola_member/modal.php") ?>
<?php include_once("partials/inc_js.php") ?>

<script>
$(document).ready(function(){

    $('.small-danger_password').remove();

    $('#add_button').click(function(){
        $('#form')[0].reset();
        $('.modal-title').text("Tambah User");
        $('.small-danger_password').remove();
        $('#action').val("Add");
        $('#operation').val("Add");
    });

    var dataTable = $('#example1').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            "url":"<?= BASE_URL; ?>admin/pages/kelola_member/fetch_data.php",
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
        var nama = $('#nama').val();
        var level = $('input[name=status]').val();
        var email = $('#email').val();
        var alamat = $('#alamat').val();
        var notelp = $('#notelp').val();
        var password = $('#password').val();
        var status = $('input[name=status]').val();

        if(status != '' || level != '' || nama != '' || email != '' || alamat != '' 
            || notelp != '' || password != '' ) {
            $.ajax({
                url:"<?= BASE_URL; ?>admin/pages/kelola_member/proses_add_edit.php",
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
        $('.small-danger_password').remove();
        var id_user = $(this).attr("id");
        $.ajax({
            url:"<?= BASE_URL; ?>admin/pages/kelola_member/fetch_single.php",
            method:"POST",
            data:{id_user:id_user},
            dataType:"json",
            success:function(data) {
                $('.danger_password').append('<small class="text-danger small-danger_password">*isi jika password akan diubah</small>');
                $('#modal').modal('show');
                $("input[name=level][value=" + data.level + "]").attr('checked', 'checked');
                $('#nama').val(data.nama);
                $('#email').val(data.email);
                $('#alamat').val(data.alamat);
                $('#notelp').val(data.notelp);
                $('#password').val(data.password);
                $("input[name=status][value=" + data.status + "]").attr('checked', 'checked');

                $('.modal-title').text("Edit User");
                $('#id_user').val(id_user);
                $('#action').val("Edit");
                $('#operation').val("Edit");
            }, error: function(xhr, status, error){
                alert(xhr.responseText);
            }
        })
    });

    $(document).on('click', '.delete', function(){
        var id_user = $(this).attr("id");
        if(confirm("Are you sure you want to delete this?")) {
            $.ajax({
                url:"<?= BASE_URL; ?>admin/pages/kelola_member/proses_delete.php",
                method:"POST",
                data:{id_user:id_user},
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