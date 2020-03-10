    
<?php

include_once("../../../db.php");
include_once("../../../helper.php");

if(isset($_POST["id_barang"])) {
    $statement = $connection->prepare(
        "UPDATE barang 
        SET remove = :remove
        WHERE id_barang = :id_barang"
    );
    $result = $statement->execute(
        array(
            ':remove' => '1',
            ':id_barang' => $_POST["id_barang"]
        )
    );
    
    if(!empty($result)) {
        echo 'Data Deleted';
    }
}



?>