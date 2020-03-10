<div class="container">
	<div class="row">
		<div class="col-lg-3">
			<ul class="list-group">
				<li class="list-group-item list-group-item-danger bg-danger ">
					<center><span style="color: #ffffff;">KATEGORI</span></center>
				</li>
				<li class="list-group-item">        
					<?php echo kategori($kategori_id); ?>
				</li>
			</ul>
		</div>

		<?php 
			if($kategori_id){
				$query = mysqli_query($koneksi, "SELECT * FROM barang WHERE status='Ready' AND id_kat='$kategori_id' AND remove=0");
			}else{
				$query = mysqli_query($koneksi, "SELECT * FROM barang WHERE status='Ready' AND remove=0");
			} 
			$perPage = 9;
			$totalRecords = mysqli_num_rows($query);
			$totalPages = ceil($totalRecords/$perPage);
		?>
		<div class="col-lg-9">
			<h3 class="font-weight-bold ml-3">SPAREPART TERBARU</h3>
			<div class="container">
				<div class="row justify-content-center" id="product-main">
					
					<!-- HARUSNYA SI DISINI MULAI PAGINATION-->
					
				</div>
				<div class="row float-right">
					<div id="pagination"></div>    
					<input type="hidden" id="totalPages" value="<?php echo $totalPages; ?>">
					<input type="hidden" id="idKategori" value="<?= $kategori_id; ?>">
				</div>
			</div>	
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

// PAGINATION AJAX
$(document).ready(function(){
	var totalPage = parseInt($('#totalPages').val());	
	var idKategori = $('#idKategori').val();	
	$('#pagination').simplePaginator({
		totalPages: totalPage,
		maxButtonsVisible: 5,
		currentPage: 1,
		nextLabel: 'Next',
		prevLabel: 'Prev',
		firstLabel: 'First',
		lastLabel: 'Last',
		clickCurrentPage: true,
		pageChange: function(page) {			
			$("#product-main").html('loading...');
            $.ajax({
				url:"pages/product_load.php",
				method:"GET",
				dataType: "json",
				data:{page:	page, id_kategori: idKategori},
				success:function(responseData){
					$('#product-main').html(responseData.html);
				},
				error:function(jqXHR, textStatus, errorThrown){
					var msg = 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown ;
					alert(msg);
				}
			});
		}
	});
});

</script>