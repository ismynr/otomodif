<?php
    ob_start();
	include_once("../../../../../db.php");
    include_once("../../../../../helper.php");

    $id_kab = $_GET['id_kab'];
    $sql = "SELECT * FROM kecamatan WHERE kabupaten_id=$id_kab";
    $query = mysqli_query($koneksi, $sql);
    $data = [];

    while($row = mysqli_fetch_assoc($query)){
        $data[] = array("id_kec" => $row['kecamatan_id'], "nama" => $row['kecamatan_nama']);
    }
    echo json_encode($data);
?>