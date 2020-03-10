<?php 
$id_user = $_SESSION['id_user'];
$row = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user'"));
?>

<h3>Profile Anda</h3>
<form action="<?= BASE_URL; ?>user/index.php?page=akun&module=profile&action=update" method="POST">
	<div class="form-group">
		<label>Nama</label>
		<span><input type="nama" class="form-control" name="nama" value="<?= $row['nama']; ?>" required/></span>
	</div>	

	<div class="form-group">
		<label>Email</label>
		<span><input type="email" class="form-control" name="email" value="<?= $row['email']; ?>" required/></span>
	</div>			

	<div class="form-group">
		<label>No Handphone</label>
		<span><input type="number" class="form-control" name="no_hp" value="<?= $row['notelp']; ?>" required/></span>
	</div>	

	<div class="form-group">
		<span><button type="submit" value="Ubah" name="submit" class="btn btn-danger">Simpan</button></span>
	</div>			
</form>