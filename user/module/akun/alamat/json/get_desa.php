<?php
    ob_start();
	include_once("../../../../../db.php");
    include_once("../../../../../helper.php");

    $id_kec = $_GET['id_kec'];
    $sql = "SELECT * FROM desa WHERE kecamatan_id=$id_kec";
    $query = mysqli_query($koneksi, $sql);
    $data = [];

    while($row = mysqli_fetch_assoc($query)){
        $data[] = array("id_kel" => $row['desa_id'], "nama" => $row['desa_nama']);
    }
    echo json_encode($data);
?>