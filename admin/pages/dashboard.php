<?php 

$stmtOtd = $connection->prepare("SELECT * FROM pesanan WHERE status=1 AND remove=0");
$stmtOtd->execute();
$rowNo = $stmtOtd->rowCount();

$stmtBp = $connection->prepare("SELECT * FROM pesanan WHERE status=2 AND remove=0");
$stmtBp->execute();
$rowBp = $stmtBp->rowCount();

$stmtPl = $connection->prepare("SELECT * FROM user WHERE level='Customer' AND remove=0 AND status='Aktif'");
$stmtPl->execute();
$rowPl = $stmtPl->rowCount();

$stmtSp = $connection->prepare("SELECT SUM(harga) AS jml FROM pesanan JOIN detail_pesanan ON pesanan.id_pesanan=detail_pesanan.id_pesanan WHERE status=5 AND remove=0");
$stmtSp->execute();
$rowSp = $stmtSp->fetch();

?>
<div class="container mt-4">
    <div class="container-fluid">
    <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $rowNo; ?></h3>

                <p>Order Telah Dibayar</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?= BASE_URL; ?>admin/index.php?page=pesanan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $rowBp; ?></h3>

                <p>Butuh Pengiriman</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= BASE_URL; ?>admin/index.php?page=pesanan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $rowPl; ?></h3>

                <p>Pelanggan</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?= BASE_URL; ?>admin/index.php?page=kelola" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= isset($rowSp["jml"]) ? rupiah($rowSp["jml"]):"0"; ?></h3>

                <p>Jumlah</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
    </div>
</div>

<?php include_once("partials/inc_js.php") ?>