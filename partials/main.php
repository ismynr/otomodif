<div class="container container-content" id="top">
        
	<!-- Slider Section -->
	<?php if(!isset($_GET["page"])){
		include_once("partials/slider.php");
	} ?>

	<div id="content">
		<?php 
		$main = (isset($_GET["page"])) ? $_GET["page"] : "";
		switch ($main) {
			case 'login':
				require_once('pages/login.php');
				break;
			case 'register':
				require_once('pages/register.php');
				break;
			case 'keranjang':
				require_once('pages/keranjang.php');
				break;
			case 'detail_produk':
				require_once('pages/product_detail.php');
				break;
			case 'checkout':
				require_once('pages/checkout.php');
				break;
			default:
				include_once('pages/product.php');
				break;
		} ?>
	</div>
</div>	