<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <ul class="list-group">
                <li class="list-group-item list-group-item-danger bg-danger "><center><span style="color: #ffffff;">KATEGORI</span></center></li>
                <li class="list-group-item">        
                <?php 	
                    echo kategori($kategori_id);
                ?>
                </li>
            </ul>
        </div>
        <div class="col-lg-9">
        <?php
            $id_barang = $_GET['id_barang'];
            
            $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id_barang' AND status='Ready' and remove=0");
            $row = mysqli_fetch_assoc($query);
            
            log__a(isset($_SESSION['id_user']) ? "$_SESSION[id_user]":"(guest user)", "view item product", 
				['id_barang'=>$id_barang, 'nama_barang'=>$row['nama_barang'], 'harga'=>rupiah($row['harga'])]);

            echo "<div id='detail-barang'>
                        <h2>$row[nama_barang]</h2>
                        <div id='frame-gambar'>
                            <img src='".BASE_URL."uploads/barang/$row[gambar]' />
                        </div>
                        <div id='frame-harga'>
                            <span>".rupiah($row['harga'])."</span>
                            <button class=\"btn btn-danger float-right\" onclick='addCart(\"".$row['id_barang']."\")'>+ add to cart</button>
                        </div>
                        <div id='keterangan'>
                            <b>Keterangan : </b> $row[spesifikasi]
                        </div>
                    </div>";				
            
        ?>
        </div>
    </div>
</div>

<script>
// ADD CART ITEM
function addCart(id){
	$.ajax({
		type: 'GET',
		url: 'pages/process/keranjang_tambah.php',
		data:"id_barang="+id,
		success:function(data){
			location.reload();
		}
	});
	return false;
}
</script>
