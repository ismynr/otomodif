<?php 
$id_user = $_SESSION['id_user'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
mysqli_query($koneksi, "UPDATE user SET nama = '$nama', email = '$email', notelp = '$no_hp' WHERE id_user='$id_user'");

$_SESSION['nama'] = $nama;

log__a($id_user, "update profile", ['nama'=>$nama, 'email'=>$email,'notelp'=>$notelp]);

$_SESSION['flash_alert'] = "<div class=\"alert alert-success\" role=\"alert\"><strong>Berhasil!</strong> profile telah diubah.</div>";
header("location:".BASE_URL."user/index.php?page=akun&module=profile&action=form");
?>