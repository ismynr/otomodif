<?php
	session_start();
	include_once("../../db.php");
	include_once("../../helper.php");

	$barang_id=$_GET['id_barang'];
	$keranjang = $_SESSION['keranjang'];

	log__a(isset($_SESSION['id_user']) ? "$_SESSION[id_user]":"(guest user)", "delete one item keranjang", 
				['id_barang'=>$barang_id,'nama_barang'=>$keranjang[$barang_id]["nama_barang"], 'quantity'=>$keranjang[$barang_id]["quantity"], 'harga'=>$keranjang[$barang_id]["harga"]]);
	
	unset($keranjang[$barang_id]);
	
	$_SESSION['keranjang'] = $keranjang;