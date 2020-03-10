<?php 
$id_user = $_SESSION['id_user'];
$pwLama = $_POST['pw_lama'];
$pwBaru = $_POST['pw_baru'];
$pwBaru2 = $_POST['pw_baru2'];


if($pwBaru == $pwBaru2){
    $encPwBaru = md5($pwBaru);
    $encPwLama = md5($pwLama);
    $row = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user' AND password='$encPwLama'");
    $jj = "SELECT * FROM user WHERE id_user='$id_user' AND password='$encPwLama'";

    if(mysqli_num_rows($row) == 0){
        $_SESSION['flash_alert'] = "<div class=\"alert alert-danger\" role=\"alert\"><strong>Gagal!</strong> password lama tidak sama dengan sebelumnya.</div>";
    }else{
        mysqli_query($koneksi, "UPDATE user SET password = '$encPwBaru' WHERE id_user='$id_user'");
        log__a($id_user, "ubah password", ['password'=>$encPwBaru]);
        $_SESSION['flash_alert'] = "<div class=\"alert alert-success\" role=\"alert\"><strong>Berhasil!</strong> password telah diubah.</div>";
    }
}else{
    $_SESSION['flash_alert'] = "<div class=\"alert alert-danger\" role=\"alert\"><strong>Gagal!</strong> password yang anda masukan tidak sama.</div>";
}
header("location:".BASE_URL."user/index.php?page=akun&module=password&action=form");

?>