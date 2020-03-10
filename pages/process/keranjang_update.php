<?php
	session_start();
	include_once("../../db.php");
	include_once("../../helper.php");
	
	$keranjang = $_SESSION["keranjang"];
    $barang_id = $_POST["id_barang"];
    $value = $_POST["value"];
	
	$keranjang[$barang_id]["quantity"] = $value+1;

	// log__a(isset($_SESSION['id_user']) ? "$_SESSION[id_user]":"(guest user)", "tambah quantity keranjang", ['id_barang'=>$barang_id]);
	log__a(isset($_SESSION['id_user']) ? "$_SESSION[id_user]":"(guest user)", "add quantity keranjang", 
				['id_barang'=>$barang_id,'nama_barang'=>$keranjang[$barang_id]["nama_barang"], 'quantity'=>$keranjang[$barang_id]["quantity"], 'harga'=>$keranjang[$barang_id]["harga"]]);
	
	$_SESSION["keranjang"] = $keranjang;