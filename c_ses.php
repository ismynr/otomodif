<?php 

session_start();
	include_once("../../db.php");
    include_once("../../helper.php");
    
    unset($_SESSION['id_user']);
	unset($_SESSION['nama']);
	unset($_SESSION['level']);
?>