<?php 
if($totalBarang != 0){
	echo "<h4 ><b>Total Keranjangmu $totalBarang</b></h4>";
}
?>

<?php if($totalBarang == 0): ?>
	<center><h3>Yaah masih kosong, ayo belanja sekarang juga.</h3></center>

<?php else: ?>
	<?php $no=1; ?>
	<?php 
	// IF DEFINITION SESSION flash_alert AVAILABLE
	if(isset($_SESSION['flash_alert'])){
		echo $_SESSION['flash_alert'];
		unset($_SESSION['flash_alert']);
	}
	?>
	<div class="table-responsive">
		<table class='table table-bordered table-striped table-hover'>
			<thead>
				<tr>
					<th><center>No</center></th>
					<th><center>Gambar</center></th>
					<th><center>Barang</center></th>
					<th><center>Jumlah</center></th>
					<th><center>Harga</center></th>
					<th><center>Total Harga</center></th>
				</tr>
			</thead>

			<?php $subtotal = 0; ?>
			<?php foreach($keranjang AS $key => $value): ?>
				<?php 
				$barang_id = $key;
				$id_barang = $value["id_barang"];
				$nama_barang = $value["nama_barang"];
				$quantity = $value["quantity"];
				$gambar = $value["gambar"];
				$harga = $value["harga"];			
				$total = $quantity * $harga;
				$subtotal = $subtotal + $total; ?>

				<tbody>
					<tr>
						<td><center><?= $no; ?></center></td>
						<td><center><img src='<?= BASE_URL."uploads/barang/$gambar"; ?>' height='80px' /></center></td>
						<td><center><?= $nama_barang; ?></center></td>
						<td>
							<center>
								<button style="background:none;border:0" onclick="minQuantity(<?= $barang_id?>, <?= $quantity?>)"><i class="fas fa-minus mr-2"></i></button>
								<input type='text' value='<?= $quantity; ?>' class='update-quantity' readonly/>
								<button style="background:none;border:0" onclick="addQuantity(<?= $barang_id?>, <?= $quantity?>)"><i class="fas fa-plus ml-2"></i></button>
							</center>
						</td>
						<td><center><?= rupiah($harga); ?></center></td>
						<td class='kanan hapus_item'><center><?= rupiah($total); ?></center><button onclick='removeCartItem("<?= $barang_id ?>")' class='close'><i class="fas fa-times"></i></button></td>
					</tr>
					<tr>
						<td colspan='5' class='kanan'><b>Sub Total</b></td>
						<td class='kanan'><b><?= rupiah($subtotal); ?></b></td>
					</tr>
				</tbody>
				
				<?php $no++; ?>
			<?php endforeach; ?>

		</table>
	</div>
	<div align="right">
		<a href='<?= BASE_URL; ?>index.php?page=checkout' class='btn btn-dark' title='Checkout Pesanan'></i>Checkout</a>
	</div>
<?php endif; ?>

<script>
// REMOVE CART ITEM QUANTITY
function minQuantity(id, val){
	$.ajax({
		method: "POST",
		url: "pages/process/keranjang_delete.php",
		data: "id_barang="+id+"&value="+val
	})
	.done(function(data){
		location.reload();
	});
}

// ADD CART ITEM QUANTITY
function addQuantity(id, val){
	$.ajax({
		method: "POST",
		url: "pages/process/keranjang_update.php",
		data: "id_barang="+id+"&value="+val
	})
	.done(function(data){
		location.reload();
	});
}

// REMOVE CART ITEM
function removeCartItem(id){
	$.ajax({
		type: 'GET',
		url: 'pages/process/keranjang_hapus_item.php',
		data:"id_barang="+id,
		success:function(data){
			location.reload();
		}
	});
	return false;
}
</script>