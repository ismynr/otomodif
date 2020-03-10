<?php
include_once("../../../db.php");
include_once("../../../helper.php");

if(isset($_POST["operation"])) {
    if($_POST["operation"] == "Add") {
        $statement = $connection->prepare("
            INSERT INTO user (level, nama, email, alamat, notelp, password, status) 
            VALUES (:level, :nama, :email, :alamat, :notelp, :password, :status)
        ");
        $result = $statement->execute(
            array(
                ':level' => $_POST["level"],
                ':nama' => $_POST["nama"],
                ':email' => $_POST["email"],
                ':alamat' => $_POST["alamat"],
                ':notelp' => $_POST["notelp"],
                ':password' => md5($_POST["password"]),
                ':status' => $_POST["status"],
            )
        );
        if(!empty($result)) {
            echo 'Data Inserted';
        }
    }
    if($_POST["operation"] == "Edit") {

        if(!isset($_POST["password"])){
            $upQuery = "";
        }else{
            $upQuery = "password = :password, ";
        }
        
        $statement = $connection->prepare(
            "UPDATE user 
            SET level = :level, nama = :nama, email = :email, alamat = :alamat, notelp = :notelp, 
                ".$upQuery." status = :status
            WHERE id_user = :id_user
            "
        );
        $queryExt = array(
            ':level' => $_POST["level"],
            ':nama' => $_POST["nama"],
            ':email' => $_POST["email"],
            ':alamat' => $_POST["alamat"],
            ':notelp' => $_POST["notelp"],
            // ':password' => md5($_POST["password"]),
            ':status' => $_POST["status"],
            ':id_user'   => $_POST["id_user"]
        );
        if(isset($_POST["password"])){
            $queryExt[':password']  = md5($_POST["password"]) ;
        }
        $result = $statement->execute($queryExt);
        if(!empty($result)) {
            echo 'Data Updated';
        }
    }
}

?>