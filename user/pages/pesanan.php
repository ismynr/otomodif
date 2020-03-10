<div id="bg-page-profile">
	<div class="row">
		<div class="col-md-3">
            <div class="mini-submenu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>
            <div class="list-group">
                <span href="#" class="list-group-item bg-info active">
                    <center>MAIN MENU</center>
                </span>
                
                <a href="<?= BASE_URL."user/index.php?pages=pesanan&module=pesanan&action=list"; ?>" class="list-group-item">
                    <i class="fas fa-dolly-flatbed"></i> Pesanan Berjalan
                </a>
                <a href="<?= BASE_URL."user/index.php?pages=pesanan&module=pesanan&action=list_selesai"; ?>" class="list-group-item">
                    <i class="fas fa-dolly-flatbed"></i> Pesanan Selesai 
                </a>
                
            </div>        
        </div>
        <div class="col-md-9 profile-content">
        <?php
                $file = "module/$module/$action.php";
                if(file_exists($file)){
                    include_once($file);
                }else if(!isset($_GET['module']) || !isset($_GET['action'])){
                    // DEFAULT USER PAGE
                    include_once("module/pesanan/list.php");
                }else{
                    include_once($file);
                    echo "<h3>Maaf, halaman tersebut tidak ditemukan</h3>";
                }
            ?>
        
        </div>
	
        
    </div>
</div>