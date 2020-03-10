<?php
session_start();
include_once("../../db.php");
include_once("../../helper.php");
    
$id_alamat = $_POST['id_alamat'];
$ongkir = $_POST['ongkir'];
$kota_tujuan = $_POST['kab_id'];
$kurir = $_POST['kurir'];
$user_id = $_SESSION['id_user'];

$createId = mysqli_fetch_array(mysqli_query($koneksi, "SELECT MAX(id_pesanan) AS id_pesanan FROM pesanan"));
$num =  "ORD" . sprintf("%05s", (substr($createId['id_pesanan'], 4, 5)+1));
// echo $num;

$query = mysqli_query($koneksi, "INSERT INTO pesanan (id_pesanan, id_user, alamat_pengiriman, ongkir, kota_tujuan, kurir, status)
                                            VALUES ('$num', '$user_id', '$id_alamat', '$ongkir', '$kota_tujuan', '$kurir', '0')");
                                            
if($query){
	$last_pesanan_id = $num;		
	$keranjang = $_SESSION['keranjang'];		
	foreach($keranjang AS $key => $value){
		$barang_id = $key;
		$quantity = $value['quantity'];
		$harga = $value['harga'];			
		mysqli_query($koneksi, "INSERT INTO detail_pesanan(id_pesanan, id_barang, quantity, harga)
												VALUES ('$last_pesanan_id', '$barang_id', '$quantity', '$harga')");
												
		log__a($user_id, "checkout produk", ['pesanan'=>['id_pesanan'=>$num,'alamat_pengiriman'=>$id_alamat,'ongkir'=>$ongkir,'kota_tujuan'=>$kota_tujuan,'kurir'=>$kurir], 'detail_pesanan'=>['id_barang'=>$barang_id, 'quantity'=>$quantity, 'harga'=>$harga]]);
	}		
    unset($_SESSION["keranjang"]);
    echo json_encode(array("last_pesanan_id"=>$last_pesanan_id));
}