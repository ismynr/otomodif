<?php
	session_start();
    include_once("../../../db.php");
    include_once("../../../helper.php");
	
    $id_pesanan = $_POST["id_pesanan"];
    $status = $_POST["status"];
	
    // query

    $statement = $connection->prepare("UPDATE pesanan SET status=:status WHERE id_pesanan=:id_pesanan");
    $result = $statement->execute(
        array(
            ':status' => $status,
            ':id_pesanan' => $id_pesanan
        )
    );
    if(!empty($result)) {
        echo 'Data Inserted';
    }