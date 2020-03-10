<?php

    $mode = isset($_GET['mode']) ? $_GET['mode']:"";
    $id_alamat = isset($_GET['id']) ? $_GET['id']:"";

    if($mode == "update"){
        echo ("<h3>Ubah Alamat</h3>");
        $query = mysqli_query($koneksi, "SELECT * FROM alamat_pengiriman WHERE id_alamat=$id_alamat AND remove=0");
        $row = mysqli_fetch_assoc($query);
    }else if($mode == "add"){
        echo ("<h3>Tambah Alamat</h3>");
    }

	if(isset($_POST["submit"])){
        $id_user = $_SESSION["id_user"];
        $nama = $_POST['nama'];
        $no_hp = $_POST['no_hp'];
        $alamat = $_POST['alamat'];
        $provinsi = $_POST['provinsi'];
        $kabupaten_kota = $_POST['kabupaten_kota'];
        $kecamatan = $_POST['kecamatan'];
        $desa = $_POST['desa'];
        $kota_tujuan = $_POST['kota_tujuan'];
        $nama_kota_tujuan = $_POST['nama_kota_tujuan'];
        
        if($mode == "add"){
            mysqli_query($koneksi, "INSERT INTO alamat_pengiriman (id_user, nama, no_hp, alamat, desa, kecamatan, kabupaten_kota, provinsi, kota_tujuan, nama_kota_tujuan)
                                            VALUES ('$id_user', '$nama', '$no_hp', '$alamat', '$desa', '$kecamatan', '$kabupaten_kota', '$provinsi', '$kota_tujuan', '$nama_kota_tujuan')");
            log__a($id_user, "add alamat", ['nama'=>$nama, 'no_hp'=>$no_hp,'alamat'=>$alamat, 'desa'=>$desa, 'kecamatan'=>$kecamatan, 'kabupaten_kota'=>$kabupaten_kota, 'provinsi'=>$provinsi, 'kota_tujuan'=>$kota_tujuan, 'nama_kota_tujuan'=>$nama_kota_tujuan]);
            $_SESSION['flash_alert'] = "<div class=\"alert alert-success\" role=\"alert\"><strong>Berhasil!</strong> ditambahkan.</div>";
        }else if($mode = "update"){
            mysqli_query($koneksi, "UPDATE alamat_pengiriman SET nama='$nama', no_hp='$no_hp', alamat='$alamat', provinsi='$provinsi', kabupaten_kota='$kabupaten_kota', desa='$desa', kota_tujuan='$kota_tujuan', nama_kota_tujuan='$nama_kota_tujuan' WHERE id_alamat='$id_alamat'");
            log__a($id_user, "update alamat", ['nama'=>$nama, 'no_hp'=>$no_hp,'alamat'=>$alamat, 'desa'=>$desa, 'kecamatan'=>$kecamatan, 'kabupaten_kota'=>$kabupaten_kota, 'provinsi'=>$provinsi, 'kota_tujuan'=>$kota_tujuan, 'nama_kota_tujuan'=>$nama_kota_tujuan]);
            $_SESSION['flash_alert'] = "<div class=\"alert alert-success\" role=\"alert\"><strong>Berhasil!</strong> perubahan disimpan.</div>";
        }
        
        header("location:".BASE_URL."user/index.php?page=akun&module=alamat&action=list");
		
	}
?>
<form action="" method="POST">
    <div class="form-group">
		<label>Nama Penerima</label>
		<span><input type="text" class="form-control" name="nama" value="<?= isset($row['nama']) ? $row['nama']:"" ?>" required/></span>
	</div>			

    <div class="form-group">
		<label>No Handphone</label>
		<span><input type="text" class="form-control" name="no_hp" value="<?= isset($row['no_hp']) ? $row['no_hp']:"" ?>" required/></span>
	</div>			

	<div class="form-group">
		<label>Alamat Lengkap</label>
        <span><textarea name="alamat" class="form-control" id="alamat" rows="5"><?= isset($row['alamat']) ? $row['alamat']:"" ?></textarea></span>
	</div>

    <div class="form-group row">
        <div class="form-group col-md-3">
            <label>Provinsi</label>
            <select class="custom-select" required="required" name="provinsi" id="provinsi" required></select>
        </div>
        <div class="form-group col-md-3">
            <label>Kabupaten / Kota</label>
            <select class="custom-select" required="required" name="kabupaten_kota" id="kabupaten" required></select>
        </div>
        <div class="form-group col-md-3">
            <label>Kecamatan</label>
            <select class="custom-select" required="required" name="kecamatan" id="kecamatan" required></select>
        </div>
        <div class="form-group col-md-3">
            <label>Desa</label>
            <select class="custom-select" required="required" name="desa" id="kelurahan" required></select>
        </div>
    </div>

    <div class="form-group">
		<label>Konfirmasi Kota Tujuan Pengiriman</label>
        <select class="custom-select" required="required" name="kota_tujuan" id="kota_tujuan" required></select>
        <input type="hidden" id="nama_kota_tujuan" name="nama_kota_tujuan">
	</div>

	<div class="form-group">
		<span><button type="submit" value="Ubah" name="submit" class="btn btn-danger">Simpan</button></span>
	</div>			
</form>

<script type="text/javascript"> 
$(document).ready(function() { 
    $("#provinsi").append('<option value="">Pilih</option>'); 
    $("#kabupaten").html(''); 
    $("#kecamatan").html(''); 
    $("#kelurahan").html(''); 
    $("#kabupaten").append('<option value="">Pilih</option>'); 
    $("#kecamatan").append('<option value="">Pilih</option>'); 
    $("#kelurahan").append('<option value="">Pilih</option>'); 
    $("#kota_tujuan").html("<option value='0'>Pilih Kota</option>");
    
    var getIdKot = '<?= isset($row['kota_tujuan']) ? $row['kota_tujuan']:""; ?>';
    $.ajax({
		type : 'GET',
		url  : '<?= BASE_URL; ?>user/module/akun/alamat/json/get_kota_tujuan.php',
		success: function (result) {
			// $("#kota_tujuan").html(result);
            var dataJson = JSON.parse(result);
            for (var i = 0; i < result.length; i++) {
                var kotTrue = dataJson.rajaongkir.results[i].city_id == getIdKot ? "selected":"";                
                $("#kota_tujuan").append('<option value="' + dataJson.rajaongkir.results[i].city_id+'" '+kotTrue+'>' + dataJson.rajaongkir.results[i].city_name + '</option>'); 
            }
		}
	});

    url = '<?= BASE_URL ?>user/module/akun/alamat/json/get_provinsi.php';
    var getIdProv = '<?= isset($row['provinsi']) ? $row['provinsi']:""; ?>';
    $.ajax({ url: url, 
        type: 'GET', 
        dataType: 'json', 
        success: function(result) { 
            for (var i = 0; i < result.length; i++) {
                var provTrue = result[i].id_prov == getIdProv ? "selected":"";
                $("#provinsi").append('<option value="' + result[i].id_prov+ '" ' +provTrue+ '>' + result[i].nama + '</option>'); 
            }
        } 
    }); 

    switch(true){
        case true:
            provinsi();
        case true:
            kabupaten();
        case true:
            kecamatan();
    }
    // provinsi();
    // kabupaten();
    // kecamatan();
});     

function provinsi(){
    var url = '<?= BASE_URL ?>user/module/akun/alamat/json/get_kabupaten.php?id_prov=<?= isset($row['provinsi']) ? $row['provinsi']:""; ?>';
    var getIdKab = '<?= isset($row['kabupaten_kota']) ? $row['kabupaten_kota']:""; ?>';
    $.ajax({ url : url, 
        type: 'GET', 
        dataType : 'json', 
        success : function(result){ 
            for(var i = 0; i < result.length; i++) {
                var kabTrue = result[i].id_kab == getIdKab ? "selected":"";
                $("#kabupaten").append('<option value="'+ result[i].id_kab +'" ' +kabTrue+ '>' + result[i].nama + '</option>'); 
            }
        } 
    });  
};
function kabupaten(){ 
    var url = '<?= BASE_URL ?>user/module/akun/alamat/json/get_kecamatan.php?id_kab=<?= isset($row['kabupaten_kota']) ? $row['kabupaten_kota']:""; ?>';
    var getIdKec = '<?= isset($row['kecamatan']) ? $row['kecamatan']:""; ?>';
    $.ajax({ url : url, 
        type: 'GET', 
        dataType : 'json', 
        success : function(result){ 
            for(var i = 0; i < result.length; i++) {
                var kecTrue = result[i].id_kec == getIdKec ? "selected":"";
                $("#kecamatan").append('<option value="'+ result[i].id_kec +'" '+ kecTrue +'>' + result[i].nama + '</option>'); 
            }
        } 
    });  
}; 
function kecamatan(){ 
    var url = '<?= BASE_URL ?>user/module/akun/alamat/json/get_desa.php?id_kec=<?= isset($row['kecamatan']) ? $row['kecamatan']:""; ?>'; 
    var getIdDes = '<?= isset($row['desa']) ? $row['desa']:""; ?>';
    $.ajax({ url : url, 
        type: 'GET', 
        dataType : 'json', 
        success : function(result){ 
            for(var i = 0; i < result.length; i++) {
                var desTrue = result[i].id_kel == getIdDes ? "selected":"";
                $("#kelurahan").append('<option value="'+ result[i].id_kel +'" '+ desTrue +'>' + result[i].nama + '</option>'); 
            }
        } 
    });  
}; 

$("#kota_tujuan").change(function(){
    var getNkt = $('#kota_tujuan option:selected').html();
    $("#nama_kota_tujuan").val(getNkt);
});
$("#provinsi").change(function(){ 
    var id_prov = $("#provinsi").val(); 
    $("#kabupaten").html(''); $("#kecamatan").html(''); 
    $("#kelurahan").html(''); $("#kabupaten").append('<option value="">Pilih</option>'); 
    $("#kecamatan").append('<option value="">Pilih</option>'); 
    $("#kelurahan").append('<option value="">Pilih</option>'); 
    var url = '<?= BASE_URL ?>user/module/akun/alamat/json/get_kabupaten.php?id_prov='+id_prov;
    var getIdKab = '<?= isset($row['kabupaten_kota']) ? $row['kabupaten_kota']:""; ?>';
    $.ajax({ url : url, 
        type: 'GET', 
        dataType : 'json', 
        success : function(result){ 
            for(var i = 0; i < result.length; i++) {
                var kabTrue = result[i].id_kab == getIdKab ? "selected":"";
                $("#kabupaten").append('<option value="'+ result[i].id_kab +'" ' +kabTrue+ '>' + result[i].nama + '</option>'); 
            }
        } 
    });  
}); 
$("#kabupaten").change(function(){ 
    var id_kab = $("#kabupaten").val(); 
    var url = '<?= BASE_URL ?>user/module/akun/alamat/json/get_kecamatan.php?id_kab=' + id_kab; 
    $("#kecamatan").html(''); $("#kelurahan").html(''); 
    $("#kecamatan").append('<option value="">Pilih</option>'); 
    $("#kelurahan").append('<option value="">Pilih</option>');
    var getIdKec = '<?= isset($row['kecamatan']) ? $row['kecamatan']:""; ?>';
    $.ajax({ url : url, 
        type: 'GET', 
        dataType : 'json', 
        success : function(result){ 
            for(var i = 0; i < result.length; i++) {
                var kecTrue = result[i].id_kec == getIdKec ? "selected":"";
                $("#kecamatan").append('<option value="'+ result[i].id_kec +'" '+ kecTrue +'>' + result[i].nama + '</option>'); 
            }
        } 
    });  
}); 
$("#kecamatan").change(function(){ 
    var id_kec = $("#kecamatan").val(); 
    var url = '<?= BASE_URL ?>user/module/akun/alamat/json/get_desa.php?id_kec=' + id_kec; $("#kelurahan").html(''); 
    $("#kelurahan").append('<option value="">Pilih</option>'); 
    var getIdDes = '<?= isset($row['desa']) ? $row['desa']:""; ?>';
    $.ajax({ url : url, 
        type: 'GET', 
        dataType : 'json', 
        success : function(result){ 
            for(var i = 0; i < result.length; i++) {
                var desTrue = result[i].id_kel == getIdDes ? "selected":"";
                $("#kelurahan").append('<option value="'+ result[i].id_kel +'" '+ desTrue +'>' + result[i].nama + '</option>'); 
            }
        } 
    });  
}); 
</script>