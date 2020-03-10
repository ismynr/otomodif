<div class="container container-content" id="top">
	<div id="content">
		<?php 
		$main = (isset($_GET["page"])) ? $_GET["page"] : "";
		switch ($main) {
            case "akun":
                include_once("pages/akun.php");
				break;
			case "pesanan":
                include_once("pages/pesanan.php");
                break;
			default:
				include_once('pages/pesanan.php');
				break;
		} ?>
	</div>
</div>	