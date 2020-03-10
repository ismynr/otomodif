    
<?php

include_once("../../../db.php");
include_once("../../../helper.php");

if(isset($_POST["id_pesanan"])) {

    $statement = $connection->prepare(
        "UPDATE pesanan 
        SET remove = :remove
        WHERE id_pesanan = :id_pesanan"
    );
    $result = $statement->execute(
        array(
            ':remove' => '1',
            ':id_pesanan' => $_POST["id_pesanan"]
        )
    );
    
    if(!empty($result)) {
        echo 'Data Deleted';
    }
}



?>