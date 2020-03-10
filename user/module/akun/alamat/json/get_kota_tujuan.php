<?php


// $getIdKot = isset($_GET['id_kot']) ? $_GET['id_kot']:"";
// $kot = $_GET['id_kot'];
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: e2fdeb4f53a04198668c3cab7ba21bc0"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  // echo $response;
}



$data = json_decode($response, true);
// echo "<option value='0'>Pilih Kota</option>";

// for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
//     $id = $data['rajaongkir']['results'][$i]['city_id'];

//     $desTrue = $id == $getIdKot ? "selected":"";
//     echo "<option value='".$id."' $getIdKot>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
// }

// for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
//   $data[] = array("id_kot" => $data['rajaongkir']['results'][$i]['city_id'], "nama" => $data['rajaongkir']['results'][$i]['city_name']);
// }
echo json_encode($data);


?>