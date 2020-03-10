<?php
    ob_start();
	include_once("../../../../../db.php");
    include_once("../../../../../helper.php");

    $id_prov = $_GET['id_prov'];
    $sql = "SELECT * FROM kabupaten_kota WHERE provinsi_id=$id_prov";
    $query = mysqli_query($koneksi, $sql);
    $data = [];

    while($row = mysqli_fetch_assoc($query)){
        $data[] = array("id_kab" => $row['kabupaten_id'], "nama" => $row['kabupaten_nama']);
    }
    echo json_encode($data);
?>