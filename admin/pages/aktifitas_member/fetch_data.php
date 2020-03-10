<?php
include_once("../../../db.php");
include_once("../../../helper.php");

function custom_echo($x, $length) {
    if(strlen($x)<=$length) {
        return $x;
    } else {
        $y=substr($x,0,$length) . '...';
        return $y;
    }
}

$query = '';
$output = array();
$query .= "SELECT * FROM log_aktifitas ";
// $queryUser = "SELECT * FROM user WHERE id_user=";

if(isset($_POST["search"]["value"])){
    // $query .= 'WHERE id_user LIKE "%'.$_POST["search"]["value"].'%" ';
    // $query .= 'OR process LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST["order"])) {
    $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
} else {
    $query .= 'ORDER BY id DESC ';
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
    $statementUser = $connection->prepare('SELECT * FROM user WHERE id_user='.$row['id_user']);
    $statementUser->execute();
    $resultUser = $statementUser->fetch();

    $sub_array = array();
    $sub_array[] = $resultUser['nama'].' ('.$row["id_user"].')';
    $sub_array[] = $row["ip_address"];
    $sub_array[] = $row["process"];
    $sub_array[] = custom_echo($row["item"], 30);
    $sub_array[] = $row["time"];
    $sub_array[] = '<button type="button" name="info" id="'.$row["id"].'" class="btn btn-info btn-sm info"><i class="fas fa-info-circle"></i></button>';
    $data[] = $sub_array;
}
$output = array(
    "draw"    => intval($_POST["draw"]),
    "recordsTotal"  =>  $filtered_rows,
    "recordsFiltered" => get_total_all_records("log_aktifitas",""),
    "data"    => $data
);
echo json_encode($output);
?>