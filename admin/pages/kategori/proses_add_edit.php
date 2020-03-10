<?php
include_once("../../../db.php");
include_once("../../../helper.php");

if(isset($_POST["operation"])) {
    if($_POST["operation"] == "Add") {
        $statement = $connection->prepare("
            INSERT INTO kategori (kategori, status) 
            VALUES (:kategori, :status)
        ");
        $result = $statement->execute(
            array(
                ':kategori' => $_POST["kategori"],
                ':status' => $_POST["status"]
            )
        );
        if(!empty($result)) {
            echo 'Data Inserted';
        }
    }
    if($_POST["operation"] == "Edit") {
        
        $statement = $connection->prepare(
            "UPDATE kategori 
            SET kategori = :kategori, status = :status
            WHERE id_kat = :id_kat
            "
        );
        $result = $statement->execute(
            array(
                ':kategori' => $_POST["kategori"],
                ':status' => $_POST["status"],
                ':id_kat'   => $_POST["id_kategori"]
            )
        );
        if(!empty($result)) {
            echo 'Data Updated';
        }
    }
}

?>