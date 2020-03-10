<?php 
		$main = (isset($_GET["page"])) ? $_GET["page"] : "";
		switch ($main) {
			case "aktifitas":
                include_once("pages/aktifitas_member.php");
				break;
			case "kelola":
                include_once("pages/kelola_member.php");
				break;
			case "pesanan":
                include_once("pages/pesanan.php");
				break;
			case "kategori":
                include_once("pages/kategori.php");
                break;
            case "barang":
                include_once("pages/barang.php");
            	break;
			default:
				include_once('pages/dashboard.php');
				break;
		}
		
?>