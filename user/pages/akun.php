<div id="bg-page-profile">
	<div class="row">
        <div class="col-md-3 sidebar">
            <div class="mini-submenu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>
            <div class="list-group">
                <span href="#" class="list-group-item bg-info active">
                    <center>MAIN MENU</center>
                </span>
                
                <a href="<?php echo BASE_URL."user/index.php?page=akun&module=profile&action=form"; ?>" class="list-group-item">
                    <i class="fas fa-user-circle"></i> Profile
                </a>
                <a href="<?php echo BASE_URL."user/index.php?page=akun&module=alamat&action=list"; ?>" class="list-group-item">
                    <i class="fas fa-map-marked-alt"></i> Alamat
                </a>
                <a href="<?php echo BASE_URL."user/index.php?page=akun&module=password&action=form"; ?>" class="list-group-item">
                    <i class="fas fa-key"></i> Ubah Password
                </a>
                
            </div>        
        </div>
        <div class="col-md-9">
            <?php
            // IF DEFINITION SESSION flash_alert AVAILABLE
            if(isset($_SESSION['flash_alert'])){
                echo $_SESSION['flash_alert'];
                unset($_SESSION['flash_alert']);
            }

            switch($module){
                case "profile":
                    include_once('module/akun/profile/'.$action.'.php');
                    break;
                case "alamat":
                    include_once('module/akun/alamat/'.$action.'.php');
                    // include_once('module/akun/alamat/form.php');
                    break;
                case "password":
                    include_once('module/akun/ubah_password/'.$action.'.php');
                    break;
                default:
                    include_once('module/akun/profile/form.php');
                    break;
            } ?> 
            <?php
             ?>    
        </div>
    
<!-- 	
	<div id="profile-content">
		<?php
			$file = "module/akun/$module/$action.php";
			if(file_exists($file)){
				include_once($file);
			}else if(!isset($_GET['module']) || !isset($_GET['action'])){
                include_once("module/pesanan/list.php");
            }else{
				echo "<h3>Maaf, halaman tersebut tidak ditemukan</h3>";
			}
		?>
	</div> -->

    </div>
</div>