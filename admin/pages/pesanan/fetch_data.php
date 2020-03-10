<?php
// include('db.php');
// include('function.php');
// ob_start();
include_once("../../../db.php");
include_once("../../../helper.php");

$query = '';
$output = array();
$query .= "SELECT * FROM pesanan WHERE remove=0 ";

if(isset($_POST["search"]["value"])){
    $query .= 'AND id_pesanan LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST["order"])) {
    $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
} else {
    $query .= 'ORDER BY id_pesanan DESC ';
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
    $statementUser = $connection->prepare("SELECT * FROM user WHERE id_user=".$row['id_user']);
    $statementUser->execute();
    $resultUser = $statementUser->fetch();

    $sub_array = array();
    $sub_array[] = $row["id_pesanan"];
    $sub_array[] = $resultUser['nama'];
    $sub_array[] = $arrayStatusPesanan[$row["status"]];
    $sub_array[] = $resultUser['notelp'];
    $sub_array[] = $resultUser['email'];
    $sub_array[] = '<a href="'.BASE_URL.'admin/index.php?page=pesanan&pesanan_id='.$row["id_pesanan"].'" class="btn btn-info btn-sm info">Info</a>
                    <button type="button" name="delete" id="'.$row["id_pesanan"].'" class="btn btn-danger btn-sm delete">Delete</button>';
    $data[] = $sub_array;
}
$output = array(
    "draw"    => intval($_POST["draw"]),
    "recordsTotal"  =>  $filtered_rows,
    "recordsFiltered" => get_total_all_records("pesanan"," WHERE remove=0"),
    "data"    => $data
);
echo json_encode($output);
?>