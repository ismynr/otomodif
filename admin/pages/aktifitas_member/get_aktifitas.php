<?php
include_once("../../../db.php");
include_once("../../../helper.php");

    if(isset($_POST["id"])) {
        $output = array();
        $statement = $connection->prepare(
            "SELECT * FROM log_aktifitas 
            WHERE id = '".$_POST["id"]."' 
            LIMIT 1"
        );
    
        $statement->execute();
        $result = $statement->fetchAll();
        
        foreach($result as $row) {
            $statementUser = $connection->prepare('SELECT * FROM user WHERE id_user='.$row['id_user']);
            $statementUser->execute();
            $resultUser = $statementUser->fetch();
            
            $output["id_user"] = $resultUser['nama'].' ('.$row["id_user"].')';
            $output["ip_address"] = $row["ip_address"];
            $output["item"] = $row["item"];
            $output["process"] = $row["process"];
            $output["time"] = $row["time"];
        }
        echo json_encode($output);
    }
?>