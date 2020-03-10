<?php
	// IF USER TRY ACCESS THIS FILE (USE URL)
	if($user_id){
		header("Location: ".BASE_URL."index.php");
	}

	// IF USER CLICK SUBMIT BUTTON LOGIN
    if(isset($_POST["register"])){
		$level = "Customer";
		$status = "Aktif";
		$nama_lengkap = $_POST['nama_lengkap'];
		$email = $_POST['email'];
		$phone = $_POST['notelp'];
		$alamat = $_POST['alamat'];
		$password = $_POST['password'];
		$re_password = $_POST['re_password'];
		
		unset($_POST['password']);
		unset($_POST['re_password']);
		$dataForm = http_build_query($_POST);
		
		$query = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email'");
		
		if(empty($nama_lengkap) || empty($email) || empty($phone) || empty($alamat) || empty($password)){
			header("location: ".BASE_URL."index.php?page=register&notif=require&$dataForm");
		}elseif($password != $re_password){
			header("location: ".BASE_URL."index.php?page=register&notif=password&$dataForm");
		}elseif(mysqli_num_rows($query) == 1){
			header("location: ".BASE_URL."index.php?page=register&notif=email&$dataForm");
		}
		else{
			$password = md5($password);
			mysqli_query($koneksi, "INSERT INTO user (level, nama, email, alamat, notelp, password, status)
											VALUES ('$level', '$nama_lengkap', '$email', '$alamat', '$phone', '$password', '$status')");												
			$_SESSION['flash_alert'] = "<div class=\"alert alert-success\" role=\"alert\"><strong>Pendaftaran berhasil</strong>, silahkan login !</div>";
			header("location: ".BASE_URL."index.php?page=login");
		}
	}
?>

<div class="container" id="container-user-akses">
	<div class="row">
		<div class="col-lg-12">
			<h3><b>PENDAFTARAN</b></h3><br>
			
			<form action="" class="was-validated" method="POST">
				<?php
					$notif = isset($_GET['notif']) ? $_GET['notif'] : false;
					$nama_lengkap = isset($_GET['nama_lengkap']) ? $_GET['nama_lengkap'] : false;
					$email = isset($_GET['email']) ? $_GET['email'] : false;
					$notelp = isset($_GET['notelp']) ? $_GET['notelp'] : false;
					$alamat = isset($_GET['alamat']) ? $_GET['alamat'] : false;
					
					if($notif == "require"){
						echo "<div class='notif'>Maaf, kamu harus melengkapi form dibawah ini</div>";
					}else if($notif == "password"){
						echo "<div class='notif'>Maaf, password yang kamu masukkan tidak sama.</div>";
					}else if($notif == "email"){
						echo "<div class='notif'>Maaf, email sudah terdaftar.</div>";
					} ?>
				<div class="form-group">
					<label for="nama">Nama Lengkap</label>
					<input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap" name="nama_lengkap" value="<?php echo $nama_lengkap; ?>" required>
					<div class="valid-feedback">Benar.</div>
					<div class="invalid-feedback">Silahkan isi Nama dengan benar.</div>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" class="form-control" id="email" placeholder="Masukkan Email" name="email" value="<?php echo $email; ?>" required>
					<div class="valid-feedback">Benar.</div>
					<div class="invalid-feedback">Silahkan isi Email dengan benar.</div>
				</div>
				<div class="form-group">
					<label for="notelp">No HP</label>
					<input type="text" class="form-control" id="notelp" placeholder="Masukkan No HP" name="notelp" value="<?php echo $notelp; ?>" required>
					<div class="valid-feedback">Benar.</div>
					<div class="invalid-feedback">Silahkan isi No HP dengan benar.</div>
				</div>
				<div class="form-group">
					<label for="alamat">Alamat</label>
					<input type="text" class="form-control" id="alamat" placeholder="Masukkan Alamat" name="alamat" value="<?php echo $alamat; ?>" required>
					<div class="valid-feedback">Benar.</div>
					<div class="invalid-feedback">Silahkan isi Alamat dengan benar.</div>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" placeholder="Masukkan Password" name="password" required>
					<div class="valid-feedback">Benar.</div>
					<div class="invalid-feedback">Silahkan isi Password dengan benar.</div>
				</div>
				<div class="form-group">
					<label for="re_password">Ketik Ulang Password</label>
					<input type="password" class="form-control" id="re_password" placeholder="Masukkan Password" name="re_password" required>
					<div class="valid-feedback">Benar.</div>
					<div class="invalid-feedback">Silahkan isi Password dengan benar.</div>
				</div>
				<button type="submit" value="register" name="register" class="btn btn-danger">Daftar</button>
				<span class="ml-2">Sudah punya akun? <a href='/otomodif/index.php?page=login'><b>Masuk</b></a></span>
			</form>
		</div>
	</div>
</div>