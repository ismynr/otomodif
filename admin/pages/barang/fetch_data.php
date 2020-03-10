<?php

include_once("../../../db.php");
include_once("../../../helper.php");

$query = '';
$output = array();
$query .= "SELECT * FROM barang WHERE remove=0 ";

if(isset($_POST["search"]["value"])){
    $query .= 'AND nama_barang LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST["order"])) {
    $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
} else {
    $query .= 'ORDER BY id_barang DESC ';
}

if($_POST["length"] != -1) {
    $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();

$stmt = $connection->prepare("SELECT * FROM kategori WHERE id_kat=:id_kat LIMIT 1"); 

foreach($result as $row) {    
    $stmt->execute([':id_kat'=>$row['id_kat']]); 
    $row2 = $stmt->fetch();
    $sub_array = array();
    $sub_array[] = $row["nama_barang"];
    $sub_array[] = $row2["kategori"];
    $sub_array[] = $row["harga"];
    $sub_array[] = $row["stok"];
    $sub_array[] = $row["status"];
    $sub_array[] = '<button type="button" name="update" id="'.$row["id_barang"].'" class="btn btn-warning btn-sm update">Update</button>
                    <button type="button" name="delete" id="'.$row["id_barang"].'" class="btn btn-danger btn-sm delete">Delete</button>';
    $data[] = $sub_array;
}
$output = array(
    "draw"    => intval($_POST["draw"]),
    "recordsTotal"  =>  $filtered_rows,
    "recordsFiltered" => get_total_all_records("barang"," WHERE remove=0"),
    "data"    => $data
);
echo json_encode($output);
?>