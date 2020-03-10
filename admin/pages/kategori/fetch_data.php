<?php
// include('db.php');
// include('function.php');
// ob_start();
include_once("../../../db.php");
include_once("../../../helper.php");

$query = '';
$output = array();
$query .= "SELECT * FROM kategori WHERE remove=0 ";

if(isset($_POST["search"]["value"])){
    $query .= 'AND kategori LIKE "%'.$_POST["search"]["value"].'%" ';
    // $query .= 'AND status LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST["order"])) {
    $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
} else {
    $query .= 'ORDER BY id_kat DESC ';
}

if($_POST["length"] != -1) {
    $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();

foreach($result as $row) {
    $sub_array = array();
    $sub_array[] = $row["kategori"];
    $sub_array[] = $row["status"];
    $sub_array[] = '<button type="button" name="update" id="'.$row["id_kat"].'" class="btn btn-warning btn-sm update">Update</button>
                    <button type="button" name="delete" id="'.$row["id_kat"].'" class="btn btn-danger btn-sm delete">Delete</button>';
    $data[] = $sub_array;
}
$output = array(
    "draw"    => intval($_POST["draw"]),
    "recordsTotal"  =>  $filtered_rows,
    "recordsFiltered" => get_total_all_records("kategori",""),
    "data"    => $data
);
echo json_encode($output);
?>