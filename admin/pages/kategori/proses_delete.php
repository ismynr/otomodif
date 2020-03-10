    
<?php

include_once("../../../db.php");
include_once("../../../helper.php");

if(isset($_POST["id_kat"])) {

    // $statement = $connection->prepare(
    //     "DELETE FROM kategori WHERE id_kat = :id_kat"
    // );
    // $result = $statement->execute(
    //     array(
    //         ':id_kat' => $_POST["id_kat"]
    //     )
    // );

    $statement = $connection->prepare(
        "UPDATE kategori 
        SET remove = :remove
        WHERE id_kat = :id_kat"
    );
    $result = $statement->execute(
        array(
            ':remove' => '1',
            ':id_kat' => $_POST["id_kat"]
        )
    );
    
    if(!empty($result)) {
        echo 'Data Deleted';
    }
}



?>