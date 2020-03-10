<?php

	$server = "localhost";
	$username = "root";
	$password = "";
	$database = "phbweb2_otomodif";
	$koneksi = mysqli_connect($server, $username, $password, $database) or die("Koneksi ke database gagal");


	
	
	// KONEKSI DB YANG PAKE PDO 
	$username = 'root';
	$password = '';
	$connection = new PDO( 'mysql:host=localhost;dbname=phbweb2_otomodif', $username, $password );