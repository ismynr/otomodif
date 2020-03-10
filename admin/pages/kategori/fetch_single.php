<?php
include_once("../../../db.php");
include_once("../../../helper.php");

if(isset($_POST["id_kat"])) {
    $output = array();
    $statement = $connection->prepare(
        "SELECT * FROM kategori 
        WHERE id_kat = '".$_POST["id_kat"]."' 
        LIMIT 1"
    );

    $statement->execute();
    $result = $statement->fetchAll();
    
    foreach($result as $row) {
        $output["kategori"] = $row["kategori"];
        $output["status"] = $row["status"];
    }
    echo json_encode($output);
}
?>