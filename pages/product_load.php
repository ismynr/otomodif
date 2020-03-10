<?php 

session_start();
include_once("../db.php");
include_once("../helper.php");

$perPage = 9;
if (isset($_GET["page"])) {  $page  = $_GET["page"];  } else {  $page=1;  };

$startFrom = ($page-1) * $perPage;  
$kategori_id = isset($_GET['id_kategori']) ? $_GET['id_kategori'] : false;

if($kategori_id){
    $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE status='Ready' AND id_kat='$kategori_id' AND remove=0 ORDER BY id_barang DESC LIMIT $startFrom, $perPage");
}else{
    $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE status='Ready' AND remove=0 ORDER BY id_barang DESC LIMIT $startFrom, $perPage");
} 

$paginationHtml = '';
while ($row = mysqli_fetch_assoc($query)) {  
	$paginationHtml.='<div class=\'col-md-4 mx-auto mb-4\'>';  
	$paginationHtml.='<div class=\'card shadow\'>';
	$paginationHtml.='<div class=\'inner\'>';
	$paginationHtml.='<a href=\'index.php?page=detail_produk&id_barang='.$row['id_barang'].'\' >'; 
	$paginationHtml.='<img class=\'card-img-top\' title=\''.$row["nama_barang"].'\' src=\'uploads/barang/'.$row["gambar"].'\' height=\'160px\' >';
	$paginationHtml.='</a>';
	$paginationHtml.='</div>'; 
    $paginationHtml.='<div class=\'card-body text-center\'>';  
    $paginationHtml.='<h5 class=\'card-title\'>';  
    $paginationHtml.='<a href=\'index.php?page=detail_produk&id_barang='.$row["id_barang"].'\' title=\''.$row["nama_barang"].'\'><b>'.mb_strimwidth($row["nama_barang"], 0, 18, " ..").'</b></a>';  
    $paginationHtml.='</h5>';  
    $paginationHtml.='<p class=\'card-text\'>';
	$paginationHtml.='<b>'.rupiah($row["harga"]).'</b><br>';
	$paginationHtml.='Stok : '.$row["stok"];
	$paginationHtml.='</p>';
	$paginationHtml.='<button class=\'btn btn-danger add-cart\' onclick=\'addCart('.$row["id_barang"].')\' title=\'Tambah Keranjang\'><i class=\'fas fa-plus\'></i> Keranjang</button>';
	$paginationHtml.='</div>';
	$paginationHtml.='</div>';
	$paginationHtml.='</div>';
} 
$jsonData = array(
	"success" => true,
	"html"	=> $paginationHtml,	
);
echo json_encode($jsonData, JSON_UNESCAPED_SLASHES); 

?>
