<?php

    $pesanan_id = $_GET["pesanan_id"];
    
    $querySelect = mysqli_query($koneksi, "SELECT * FROM konfirmasi_pembayaran WHERE id_pesanan='$pesanan_id'");
	$row = mysqli_fetch_assoc($querySelect);

	if(isset($_POST["konfirmasi_pembayaran"])){

		// UPDATE REKENING PEMBAYARAN
		$nomor_rekening = $_POST['nomor_rekening'];
		$nama_account = $_POST['nama_account'];
		$tanggal_transfer = $_POST['tanggal_transfer'];

        mysqli_query($koneksi, "UPDATE konfirmasi_pembayaran SET no_rek='$nomor_rekening', nama_akun='$nama_account', tanggal_transfer='".$tanggal_transfer."'
						WHERE id_pesanan='$pesanan_id'");
		log__a($user_id, "update rekening pembayaran pesanan", ['id_pesanan'=>$pesanan_id,'no-rek'=>$nomor_rekening,'nama_akun'=>$nama_account,'tanggal_transfer'=>$tanggal_transfer]);

		header("location:".BASE_URL."user/index.php?page=pesanan&module=pesanan&action=rekening&pesanan_id=$pesanan_id");
	}

	$querySelectP = mysqli_query($koneksi, "SELECT * FROM pesanan WHERE id_pesanan='$pesanan_id'");
    $rowP = mysqli_fetch_assoc($querySelectP);

?>

<h3>Rekening Account</h3>
<table class="table-list">
	<form action="" method="POST">
		<div class="form-group">
			<label>Nomor Rekening</label>
			<span><input type="number" class="form-control" name="nomor_rekening" value="<?= $row["no_rek"]; ?>" required/></span>
		</div>	

		<div class="form-group">
			<label>Nama Account</label>
			<span><input type="text" class="form-control" name="nama_account" value="<?= $row["nama_akun"]; ?>" required/></span>
		</div>		
	
		<div class="form-group">
			<label>Tanggal Transfer</label>
			<span><input type="date" class="form-control" name="tanggal_transfer" id="tanggal_transfer" value="<?= $row["tanggal_transfer"]; ?>" required/></span>
		</div>	
		<?php if($rowP['status'] == 1 || $rowP['status'] == 3): ?>
			<div class="form-group">
				<span><button type="submit" value="Konfirmasi" name="konfirmasi_pembayaran" class="btn btn-danger">Simpan</button></span>
			</div>		
		<?php endif; ?>
	
	</form>

</table>