<?php 
session_start();
ob_start();
include_once("../db.php");
include_once("../helper.php");

$module = isset($_GET['module']) ? $_GET['module'] : false;
$action = isset($_GET['action']) ? $_GET['action'] : false;
$page = isset($_GET['page']) ? $_GET['page'] : false;
$user_id = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : false;
$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : false;
$level = isset($_SESSION['level']) ? $_SESSION['level'] : false;


// REDIRECT JIKA BELUM LOGIN
if($user_id == false){
    $_SESSION['flash_alert'] = "<div class=\"alert alert-danger\" role=\"alert\"> Anda harus login/register terlebih dahulu ! </div>";
    header("location: ".BASE_URL."index.php?page=login");
}else{
    // JIKA SUDAH LOGIN TP BLOCK USER YANG TIDAK SESUAI DENGAN ROLE NYA
    if($level != "SuperAdmin"){
        $_SESSION['flash_alert'] = "<div class=\"alert alert-danger\" role=\"alert\"> Tidak dapat menampilkan halaman yang diminta ! </div>";
        header("location: ".BASE_URL."index.php?page=login");
    }
}
?>

<!DOCTYPE html>
<html>
    <!-- Header Section -->
	<?php include_once("partials/header.php"); ?>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
        
            <!-- Navbar Top Section -->
            <?php include_once("partials/navbar.php") ?>

            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="<?= BASE_URL ?>admin" class="brand-link">
                    <!-- <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                        style="opacity: .8"> -->
                    <span class="brand-text font-weight-light">Admin Otomodif</span>
                </a>

                <div class="sidebar">
                    <?php include_once("partials/sidebar.php") ?>
                </div>
            </aside>

            <div class="content-wrapper">
                <?php include_once("partials/main.php") ?>
            </div>

            <!-- Footer Section -->
            <?php include_once("partials/footer.php"); ?>

        </div>
        <!-- ./wrapper -->
    </body>
</html>
<?php mysqli_close($koneksi); ?>