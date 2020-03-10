<?php
	session_start();
	include_once("../../db.php");
	include_once("../../helper.php");
	
	$barang_id = $_GET['id_barang'];
	$keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : false;	
	
	$query = mysqli_query($koneksi, "SELECT id_barang, nama_barang, gambar, harga FROM barang WHERE id_barang='$barang_id' AND remove=0");
	$row = mysqli_fetch_assoc($query);

	log__a(isset($_SESSION['id_user']) ? "$_SESSION[id_user]":"(guest user)", "add keranjang", 
				['id_barang'=>$barang_id,'nama_barang'=>$row["nama_barang"], 'quantity'=>1, 'harga'=>$row["harga"]]);

	$keranjang = $_SESSION["keranjang"];

	// foreach($keranjang AS $key => $value){
	// 	// if($keranjang[$barang_id]["id_barang"] == $barang_id){
	// 	// 	$getValue = $keranjang[$barang_id]["quantity"];
	// 	// 	$keranjang[$barang_id]["quantity"] = $getValue+1;
	// 	// }
	// 	if($value["id_barang"] == $barang_id){
	// 		$getValue = $value["quantity"];
	// 		$keranjang[$getValue]["quantity"] = $getValue+1;
	// 	}
	// }

	$keranjang[$barang_id] = array("id_barang" => $row["id_barang"],
								   "nama_barang" => $row["nama_barang"],
								   "gambar" => $row["gambar"],
								   "harga" => $row["harga"],
								   "quantity" => 1);

	$_SESSION["keranjang"] = $keranjang;
