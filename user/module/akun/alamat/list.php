<h3>Alamat Saya</h3>
<div class="container">

    <div class="row">
        <a href="<?= BASE_URL; ?>user/index.php?page=akun&module=alamat&action=form&mode=add" style="width: 100% !important; ">
        <div class="card border-0 mb-4" >
            <div class="card-header bg-info text-white">
                <span class="float-left">Tambah alamat baru</span>
                <span class="float-right"><i class="fas fa-plus"></i></span>
            </div>
        </div>
        </a>
    </div>
    <?php 
    $id_user = $_SESSION['id_user']; 
    $query = mysqli_query($koneksi, "SELECT * FROM alamat_pengiriman WHERE id_user=$id_user AND remove=0");
    while($row = mysqli_fetch_assoc($query)){ 
        $getDesa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM desa WHERE desa_id=".$row['desa']));
        $getKec = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kecamatan WHERE kecamatan_id=".$row['kecamatan']));
        $getKab = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kabupaten_kota WHERE kabupaten_id=".$row['kabupaten_kota']));
        $getProv = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM provinsi WHERE provinsi_id=".$row['provinsi']));
         ?>

        <div class="row">
            <div class="card border-0 mb-4" style="width: 100%;">
                <div class="card-header bg-info text-white" >
                    <span class="float-left"><?= $row['nama']; ?></span>
                    <span class="float-right">
                        
                    </span>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <?= $row['no_hp']; ?> <br>
                        <?= $row['alamat']; ?> <br>
                        <span class="float-left"><?= $getDesa['desa_nama']; ?> - <?= $getKec['kecamatan_nama']; ?> - <?= $getKab['kabupaten_nama']; ?> -  <?= $getProv['provinsi_nama']; ?></span>
                        <span class="float-right">
                            <a href="<?= BASE_URL; ?>user/index.php?page=akun&module=alamat&action=form&mode=update&id=<?= $row['id_alamat']; ?>" class="btn btn-warning pb-1 pt-1 text-white"><i class="fas fa-pen pr-1"></i>Ubah</a>
                            <a href="<?= BASE_URL; ?>user/index.php?page=akun&module=alamat&action=hapus&id=<?= $row['id_alamat']; ?>" class="btn btn-danger pb-1 pt-1 text-white"><i class="fas fa-trash pr-1"></i>Hapus</a>
                        </span>
                        
                    </p>
                </div>
            </div>
        </div>

    <?php } ?>

    
</div>
