<?php 
    session_start();
    ob_start();
	include_once("./db.php");
    include_once("./helper.php");
    
    $page = isset($_GET['page']) ? $_GET['page'] : false;
    $kategori_id = isset($_GET['id_kategori']) ? $_GET['id_kategori'] : false;
    $user_id = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : false;
    $nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : false;
    $level = isset($_SESSION['level']) ? $_SESSION['level'] : false;
    $keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : array();
    $totalBarang = count($keranjang);
?>
<!DOCTYPE html>
<html>
    <!-- Header Section -->
	<?php include_once("partials/header.php"); ?>

    <!-- Navbar Top Section -->
    <?php include_once("partials/navbar.php") ?>

    <body>
        <!-- Main Section -->
        <?php include_once("partials/main.php") ?>

        <!-- Footer Section -->
        <?php include_once("partials/footer.php"); ?>

        <!-- JS Section -->
        <?php include_once("partials/inc_js.php") ?>
    </body>
</html>
<?php mysqli_close($koneksi); ?>
