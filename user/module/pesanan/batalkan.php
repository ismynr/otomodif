<?php 
    $pesanan_id = $_GET["pesanan_id"];
    mysqli_query($koneksi, "UPDATE pesanan SET STATUS=6 WHERE id_pesanan='$pesanan_id'");
    log__a($user_id, "batalkan pesanan", ['id_pesanan'=>$pesanan_id]);

    header("location:".BASE_URL."user/index.php?page=pesanan&module=pesanan&action=list_selesai");
?>