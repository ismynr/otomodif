<?php
include_once("../../../db.php");
include_once("../../../helper.php");

if(isset($_POST["id_barang"])) {
    $idb = $_POST["id_barang"];
    $output = array();
    $statement = $connection->prepare(
        "SELECT * FROM barang 
        WHERE id_barang = '".$idb."' 
        LIMIT 1"
    );

    $statement->execute();
    $result = $statement->fetchAll();
    
    foreach($result as $row) {
        $output["id_kat"] = $row["id_kat"];
        $output["nama_barang"] = $row["nama_barang"];
        $output["spesifikasi"] = $row["spesifikasi"];
        // $output["gambar"] = $row["gambar"];
        $output["harga"] = $row["harga"];
        $output["berat"] = $row["berat"];
        $output["stok"] = $row["stok"];
        $output["status"] = $row["status"];

        if($row["gambar"] != '') {
            $output['gambar'] = '<img src="'.BASE_URL.'uploads/barang/'.$row["gambar"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["gambar"].'" />';
        } else {
            $output['gambar'] = '<input type="hidden" name="hidden_user_image" value="" />';
        }
    }
    echo json_encode($output);
}
?>