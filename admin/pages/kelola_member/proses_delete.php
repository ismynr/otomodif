    
<?php

include_once("../../../db.php");
include_once("../../../helper.php");

if(isset($_POST["id_user"])) {
    $statement = $connection->prepare(
        "UPDATE user 
        SET remove = :remove
        WHERE id_user = :id_user"
    );
    $result = $statement->execute(
        array(
            ':remove' => '1',
            ':id_user' => $_POST["id_user"]
        )
    );
    
    if(!empty($result)) {
        echo 'Data Deleted';
    }
}



?>