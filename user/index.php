<?php 
    session_start();
    ob_start();
	include_once("../db.php");
    include_once("../helper.php");
    
    $page = isset($_GET['page']) ? $_GET['page'] : false;
    $kategori_id = isset($_GET['id_kategori']) ? $_GET['id_kategori'] : false;
    $user_id = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : false;
    $nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : false;
    $level = isset($_SESSION['level']) ? $_SESSION['level'] : false;
    $keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : array();
    $totalBarang = count($keranjang);

    $module = isset($_GET['module']) ? $_GET['module'] : false;
	$action = isset($_GET['action']) ? $_GET['action'] : false;
	// $mode = isset($_GET['mode']) ? $_GET['mode'] : false;

    // REDIRECT JIKA BELUM LOGIN
    if($user_id == false){
        $_SESSION['flash_alert'] = "<div class=\"alert alert-danger\" role=\"alert\"> Anda harus login/register terlebih dahulu ! </div>";
		header("location: ".BASE_URL."index.php?page=login");   
	}else{
        // JIKA SUDAH LOGIN TP BLOCK USER YANG TIDAK SESUAI DENGAN ROLE NYA
        if($level != "Customer"){
            $_SESSION['flash_alert'] = "<div class=\"alert alert-danger\" role=\"alert\"> Tidak dapat menampilkan halaman yang diminta ! </div>";
            header("location: ".BASE_URL."index.php?page=login");
        }
    }
?>
<!DOCTYPE html>
<html>
    <!-- Header Section -->
	<?php include_once("../partials/header.php"); ?>

    <!-- Navbar Top Section -->
    <?php include_once("../partials/navbar.php") ?>

    <body>
        <!-- Main Section (Local main folder) -->
        <?php include_once("partials/main.php") ?>

        <!-- Footer Section -->
        <?php include_once("../partials/footer.php"); ?>

        <!-- JS Section -->
        <?php include_once("../partials/inc_js.php") ?>
    </body>
</html>
<?php mysqli_close($koneksi); ?>