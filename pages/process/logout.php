<?php

	session_start();
	include_once("../../db.php");
	include_once("../../helper.php");

	if($user_id == false){
		header("Location: ".BASE_URL."index.php");
	}
	
	log__a($_SESSION['id_user'], "logout", ['level'=>$_SESSION['level']]);
	
	unset($_SESSION['id_user']);
	unset($_SESSION['nama']);
	unset($_SESSION['level']);

	$_SESSION['flash_alert'] = "<div class=\"alert alert-success\" role=\"alert\"> Berhasil logout ! </div>";
	header("location: ".BASE_URL."index.php?page=login");
	

?>