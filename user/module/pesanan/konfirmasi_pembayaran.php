<?php

	$pesanan_id = $_GET["pesanan_id"];

	if(isset($_POST["konfirmasi_pembayaran"])){
		
		// TAMBAH REKENING KONFIRMASI PEMBAYARAN
		$nomor_rekening = $_POST['nomor_rekening'];
		$nama_account = $_POST['nama_account'];
		$tanggal_transfer = $_POST['tanggal_transfer'];

		$queryPembayaran = mysqli_query($koneksi, "INSERT INTO konfirmasi_pembayaran (id_pesanan, no_rek, nama_akun, tanggal_transfer)
																				VALUES ('$pesanan_id', '$nomor_rekening', '$nama_account', '$tanggal_transfer')");																		
		if($queryPembayaran){
			mysqli_query($koneksi, "UPDATE pesanan SET status='1' WHERE id_pesanan='$pesanan_id'");
			log__a($user_id, "konfirmasi pembayaran pesanan", ['id_pesanan'=>$pesanan_id,'no-rek'=>$nomor_rekening,'nama_akun'=>$nama_account,'tanggal_transfer'=>$tanggal_transfer]);
		}

		header("location:".BASE_URL."user/index.php?page=pesanan&module=pesanan&action=list");	
	}

?>

<table class="table-list">

	<form action="" method="POST">
	
		<div class="form-group">
			<label>Nomor Rekening</label>
			<span><input type="number" class="form-control" name="nomor_rekening" required/></span>
		</div>	

		<div class="form-group">
			<label>Nama Account</label>
			<span><input type="text" class="form-control" name="nama_account" required/></span>
		</div>		
	
		<div class="form-group">
			<label>Tanggal Transfer</label>
			<span><input type="date" class="form-control" name="tanggal_transfer" id="tanggal" required/></span>
		</div>	

		<div class="form-group">
			<span><button type="submit" value="Konfirmasi" name="konfirmasi_pembayaran" class="btn btn-danger">Konfirmasi</button></span>
		</div>		
	
	</form>

</table>
