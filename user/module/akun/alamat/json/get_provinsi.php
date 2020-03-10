<?php
    ob_start();
	include_once("../../../../../db.php");
    include_once("../../../../../helper.php");

    $sql = "SELECT * FROM provinsi";
    $query = mysqli_query($koneksi, $sql);
    $data = [];

    while($row = mysqli_fetch_assoc($query)){
        $data[] = array("id_prov" => $row['provinsi_id'], "nama" => $row['provinsi_nama']);
    }
    echo json_encode($data);
?>