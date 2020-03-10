<?php
include_once("../../../db.php");
include_once("../../../helper.php");

if(isset($_POST["operation"])) {
    if($_POST["operation"] == "Add") {

        $gambar = '';
        if($_FILES["gambar"]["name"] != '') {
            $gambar = upload_image();
        }

        $statement = $connection->prepare("
            INSERT INTO barang (id_kat, nama_barang, spesifikasi, gambar, harga, berat, stok, status) 
            VALUES (:id_kat, :nama_barang, :spesifikasi, :gambar, :harga, :berat, :stok, :status)
        ");
        $result = $statement->execute(
            array(
                ':id_kat' => $_POST["id_kat"],
                ':nama_barang' => $_POST["nama_barang"],
                ':spesifikasi' => $_POST["spesifikasi"],
                ':gambar' => $gambar,
                ':harga' => $_POST["harga"],
                ':berat' => $_POST["berat"],
                ':stok' => $_POST["stok"],
                ':status' => $_POST["status"]
            )
        );
        if(!empty($result)) {
            echo 'Data Inserted';
        }
    }
    if($_POST["operation"] == "Edit") {

        $gambar = '';
        if($_FILES["gambar"]["name"] != '') {
            $gambar = upload_image();
        } else {
            $gambar = $_POST["hidden_user_image"];
        }
        
        $statement = $connection->prepare(
            "UPDATE barang 
            SET nama_barang = :nama_barang, id_kat = :id_kat, spesifikasi = :spesifikasi, gambar = :gambar, harga = :harga, berat = :berat,
            stok = :stok, status = :status
            WHERE id_barang = :id_barang"
        );
        $result = $statement->execute(
            array(
                ':id_kat' => $_POST["id_kat"],
                ':nama_barang' => $_POST["nama_barang"],
                ':spesifikasi' => $_POST["spesifikasi"],
                ':gambar' => $gambar,
                ':harga' => $_POST["harga"],
                ':berat' => $_POST["berat"],
                ':stok' => $_POST["stok"],
                ':status' => $_POST["status"],
                ':id_barang' => $_POST["id_barang"]
            )
        );
        if(!empty($result)) {
            echo 'Data Updated';
        }
    }
}

?>