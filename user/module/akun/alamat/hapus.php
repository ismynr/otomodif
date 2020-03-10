<?php 
$id_alamat = isset($_GET['id']) ? $_GET['id']:"";
mysqli_query($koneksi, "UPDATE alamat_pengiriman SET remove=1 WHERE id_alamat='$id_alamat'");

log__a($user_id, "delete alamat", ['id_alamat'=>$id_alamat]);

$_SESSION['flash_alert'] = "<div class=\"alert alert-success\" role=\"alert\"><strong>Berhasil!</strong> alamat telah dihapus.</div>";
header("location:".BASE_URL."user/index.php?page=akun&module=alamat&action=list");
?>