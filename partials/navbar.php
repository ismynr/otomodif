<style type="text/css">
    .dropdown-toggle, .dropdown-menu {
        border-radius: 0px !important;
    }
    .dropdown-item:hover {
        color: white;
        background-color: #dc3545;
    }
    .dropdown:hover>.dropdown-menu {
      display: block;
    }
</style>

<nav class="navbar navbar-expand-lg bg-danger">
    <!-- class="container">
        <!-- Navbar Logo -->
        <a class="navbar-brand" href="<?php echo BASE_URL."index.php"; ?>">
            <img src="<?php echo BASE_URL."assets/img/Otomodif.png"; ?>" alt="Logo" style="width:250px;">
        </a>  

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-icon"><i class="fas fa-bars"></i></span>
        </button>

        <!-- Header Navbar Links -->
        <div class="collapse navbar-collapse " id="collapsibleNavbar" >
            <ul class="navbar-nav ml-auto">
                <li><a href="<?php echo BASE_URL; ?>" class="mr-4"><b><span style="color: #ffffff;">Beranda</span></b></a></li>
                <li><a href="<?php echo BASE_URL."index.php?page=hubungi"; ?>" class="mr-4"><b><span style="color: #ffffff;">Hubungi Kami</span></b></a></li>
                <li><a href="<?php echo BASE_URL."index.php?page=keranjang"; ?>" id="button-keranjang" class="mr-4">
                    <img src="<?php echo BASE_URL."assets/img/cart.png"; ?>" /> 
                    <?php
                    if($totalBarang != 0){
                        echo "<span class='total-barang'>$totalBarang</span>";
                    } ?>
                </a></li>
                
                <!-- <div <div id="user"> -->
                <li class="nav-item"><span style='color: #ffffff;' class="ml-2 mr-4">|</span></li>
                    <?php if($user_id != false && $level === "Customer"): ?>
                        <li class="nav-item"><span style='color: #ffffff;font-weight:normal;margin-right: -12px;' class="nav-link">Selamat Datang</span></b></li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle nav-link" style="cursor: pointer" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b style='color: #ffee05;' class="ml-2 mr-4"><?= $nama ?></b></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="<?= BASE_URL ?>user/index.php?page=akun">Akun Saya</a>
                                <a class="dropdown-item" href="<?= BASE_URL ?>user">Pesanan Saya</a>
                            </div>
                        <!-- </li><span style='color: #ffffff;' class="ml-2 mr-4">|</span> -->
                        <li class="nav-item"><a class="nav-link" href='<?= BASE_URL ?>pages/process/logout.php'><b><span style='color: #ffffff;''>Keluar</span></b></a></li>
                    <?php else: ?>
                        
                        <li class="nav-item"><a class="nav-link" href='<?= BASE_URL; ?>index.php?page=login'><b><span style='color: #ffffff;''>Masuk</span></b></a></li>
                        <li class="nav-item"><a href='<?= BASE_URL ?>index.php?page=register'  class='btn btn-outline-light ml-3' role='button' title='Daftar Sekarang'></i>Daftar</a></li>
                    <?php endif; ?>
                <!-- </div> -->
            </ul>

    </div>
  </nav>
  <style>
  .dropdown-toggle::after{
    border-top:none !important;
  }
  </style>