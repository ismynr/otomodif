<?php
include_once("../../../db.php");
include_once("../../../helper.php");

if(isset($_POST["id_user"])) {
    $output = array();
    $statement = $connection->prepare(
        "SELECT * FROM user 
        WHERE id_user = '".$_POST["id_user"]."' 
        LIMIT 1"
    );

    $statement->execute();
    $result = $statement->fetchAll();
    
    foreach($result as $row) {
        $output["level"] = $row["level"];
        $output["nama"] = $row["nama"];
        $output["email"] = $row["email"];
        $output["alamat"] = $row["alamat"];
        $output["notelp"] = $row["notelp"];
        // $output["password"] = md5($_POST["password"]);
        $output["status"] = $row["status"];
    }
    echo json_encode($output);
}
?>