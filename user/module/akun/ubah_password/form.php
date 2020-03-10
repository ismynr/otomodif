<?php 
$id_user = $_SESSION['id_user'];
?>

<h3>Ubah Password Anda</h3>
<form action="<?= BASE_URL; ?>user/index.php?page=akun&module=password&action=update" method="POST">
	<div class="form-group">
		<label>Password lama</label>
		<span><input type="password" class="form-control" name="pw_lama" required/></span>
	</div>	

	<div class="form-group">    
		<label>Password baru</label>
		<span><input type="password" class="form-control" name="pw_baru" required/></span>
	</div>			

	<div class="form-group">
		<label>Ulang password baru</label>
		<span><input type="password" class="form-control" name="pw_baru2" required/></span>
	</div>	

	<div class="form-group">
		<span><button type="submit" value="Ubah" name="submit" class="btn btn-danger">Simpan</button></span>
	</div>			
</form>