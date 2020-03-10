<?php	
	if($user_id == false){
		$_SESSION["proses_pesanan"] = true;
		
		$_SESSION['flash_alert'] = "<div class=\"alert alert-danger\" role=\"alert\"> Anda harus login/register terlebih dahulu ! </div>";
		header("location: ".BASE_URL."index.php?page=login");
	}
	?>

<div id="bg-page-profile" class="mt-5">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="container">
					<div class="row">
						<div class="card border-0" style="width: 100% !important; ">
							<div class="card-header bg-info text-white">
								<span class="float-left">Pilih alamat pengiriman</span>
								<span class="float-right"><i class="fas fa-search"></i></span>
							</div>
							<div class="card-body pt-0">
								<div class="card-text demonstration pureCSS">
									<?php 
									$id_user = $_SESSION['id_user']; 
									$query = mysqli_query($koneksi, "SELECT * FROM alamat_pengiriman WHERE id_user=$id_user AND remove=0");
									if(mysqli_num_rows($query) == 0){
										echo "<p class=\"mt-4\">Anda belum menambahkan alamat, <a href=\"".BASE_URL."user/index.php?page=akun&module=alamat&action=list\">Klik disini</a> untuk menambahkan alamat</p>";
									}
									while($row = mysqli_fetch_assoc($query)){ 
										$getDesa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM desa WHERE desa_id=".$row['desa']));
										$getKec = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kecamatan WHERE kecamatan_id=".$row['kecamatan']));
										$getKab = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kabupaten_kota WHERE kabupaten_id=".$row['kabupaten_kota']));
										$getProv = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM provinsi WHERE provinsi_id=".$row['provinsi']));
										
										?>
										<div class="list_alamat m-0">
											<input id="radioPureCSS<?= $row['id_alamat']; ?>" type="radio" name="radioPureCSS" id-kota_tujuan="<?= $row['kota_tujuan']; ?>" id-nama_kota_tujuan="<?= $row['nama_kota_tujuan']; ?>" value="<?= $row['id_alamat']; ?>">
											<label for="radioPureCSS<?= $row['id_alamat']; ?>"><span><span></span></span>
												<?= $row['nama']; ?> (<?= $row['no_hp']; ?>) <br>
												<?= $row['alamat']; ?> <br>
												
												Kota Pengiriman <font class="text-info font-weight-bold" ><?= $row['nama_kota_tujuan']; ?></font> <br>
												<font class="text-info font-weight-bold"><?= $getDesa['desa_nama']; ?> - <?= $getKec['kecamatan_nama']; ?> - <?= $getKab['kabupaten_nama']; ?> -  <?= $getProv['provinsi_nama']; ?></font>
											</label>
											<!-- <input type="hidden" id="kota_tujuan" name="kota_tujuan" value="<?= $row['kota_tujuan']; ?>"> -->
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 mb-5">
				<div id="frame-detail-order">	
					<table class="table-list" id="table-list">
						<tr class="bg-info text-white">
							<th class='kiri'>Nama Barang</th>
							<th class='tengah'>Qty</th>
							<th class='kanan'>Total</th>
						</tr>
						
						<?php
							$subtotal = 0;
							$jmlBeratBarang = 0;
							foreach($keranjang AS $key => $value){
								$barang_id = $key;
								$getBerat = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT berat FROM barang WHERE id_barang='$barang_id'"));
								
								$nama_barang = $value['nama_barang'];
								$harga = $value['harga'];
								$quantity = $value['quantity'];
								
								$total = $quantity * $harga;
								$subtotal = $subtotal + $total;
								
								echo "<tr>
										<td class='kiri'>$nama_barang</td>
										<td class='tengah'>$quantity</td>
										<td class='kanan'>".rupiah($total)."</td>
									</tr>";

								//const total berat barang untuk ongkir
								$jmlBeratBarang += $getBerat['berat'];
							}
							echo "<tr class='bg-info text-white'>
									<td colspan='2' class='kanan'><b>Total</b></td>
									<td class='kanan'><b>".rupiah($subtotal)."</b></td>
								</tr>";
							echo "<tr class='bg-info text-white' id='tr_ongkir'></tr>";
							echo "<tr class='bg-info text-white' id='tr_ongkir_val'></tr>";
							echo "<tr class='bg-info text-white' id='tr_sub_total'></tr>";
							
						?>
						
					</table>
				</div>
				
				<div class="container m-0 pt-4 pr-0 pb-0 pl-0">
					<div class="form-group row">
						<!-- <div class="form-group col-lg-5">
							<label>Kota Tujuan</label>
							<select class="custom-select" required="required" name="kota" id="kota"></select>
						</div> -->
						<div class="form-group col-lg-9">
							<label>Jasa Pengiriman</label>
							<select id="kurir" class="custom-select" name="kurir">
								<option value="jne">JNE REG</option>
								<option value="tiki">TIKI REG</option>
								<option value="pos">POS INDONESIA KILAT</option>
							</select>
						</div>
						<div class="form-group col-lg-3 mt-4 pt-2">
							<input id="cek" type="submit" class="btn btn-success" value="Buat Pesanan"/>
						</div>
					</div>
				</div>
				
				<div id='ongkir'></div>
			</div>
		</div>
	</div>
</div>


<script>
$(document).ready(function(){
	$('#tr_ongkir').html("<td colspan='2' class='kanan'><b>Ongkir</b></td><td class='kanan' id='loading'><b>0</b></td>");
	$('#tr_sub_total').html("<td colspan='2' class='kanan'><b>Sub Total</b></td><td class='kanan'><b><?= rupiah($subtotal); ?></b></td>");

	$("#cek").click(function(){
		var asal = "472"; //get id tegal city in api rajaongkir.com
		var kab = $('input[name=radioPureCSS]:checked').attr("id-nama_kota_tujuan");	
		var kurir = $('#kurir').val();
		var berat = <?= $jmlBeratBarang; ?>; 
		var id_alamat = $('input[name=radioPureCSS]:checked').val();
		var ongkir = $("#val_ongkir_cost").val();

		if(kab == 0){
			$("#ongkir").html("<div class=\"alert alert-danger alertAutoClose\" role=\"alert\"> Mohon untuk memilih tujuan kota untuk biaya ongkir</div>");
		} else if($('#loading').text() == "Tidak tersedia"){
			$("#ongkir").html("<div class=\"alert alert-danger alertAutoClose\" role=\"alert\"> Jasa pengiriman tidak tersedia, Mohon untuk mengganti jasa pengiriman</div>");
		} else{
			if(id_alamat == undefined){
				$("#ongkir").html("<div class=\"alert alert-danger alertAutoClose\" role=\"alert\"> Mohon untuk memilih alamat pengiriman</div>");
			}else{
				$.ajax({
					type : 'POST',
					url : '<?= BASE_URL; ?>pages/checkout/checkout_proses.php',
					data :  {'kab_id' : kab, 'id_alamat' : id_alamat, 'ongkir' : ongkir, 'kurir' : kurir, 'asal' : asal, 'berat' : berat},
					dataType:'JSON',
					success: function (response) {
						// $("#ongkir").text("beneer");		
						var timer = setTimeout(function() {window.location= '<?= BASE_URL; ?>user/index.php?page=pesanan&module=pesanan&action=detail&pesanan_id='+response.last_pesanan_id}, 0);
					},
					error: function() {
						alert('ajax error');
					}
				});
			}
			alertAutoClose(".alertAutoClose");
		}
	});

	function alertAutoClose(selector){
		$(selector).delay(3000).fadeTo(1000, 0).slideUp(200, function(){
			$(selector).slideUp(200);
		});
	}

	$("#kurir").change(function(){
		getOngkir();
	});

	$("input[name='radioPureCSS']").change(function(){
		getOngkir();
	});

	function getOngkir(){
		var asal = "473"; //get id tegal city in api rajaongkir.com
		var kab = $('input[name=radioPureCSS]:checked').attr("id-kota_tujuan");	
		var kurir = $('#kurir').val();
		var berat = <?= $jmlBeratBarang; ?>; 
		$('#tr_ongkir').html("<td colspan='2' class='kanan'><b>Ongkir</b></td><td class='kanan' id='loading'><b>Loading ... </b></td>");
		
      	$.ajax({
            type : 'POST',
           	url : '<?= BASE_URL; ?>pages/checkout/check_ongkir.php',
            data :  {'kab_id' : kab, 'kurir' : kurir, 'asal' : asal, 'berat' : berat},
			success: function (data) {
				var as = JSON.parse(data);
				
				// KURIR REG AND ECONOMY
				var DEF = false;
				var getValueJson = "";

				for(var i=0;i<as.rajaongkir.results[0].costs.length;i++){
					
					if(as.rajaongkir.results[0].costs[i].service == "REG" || as.rajaongkir.results[0].costs[i].service == "Paket Kilat Khusus"){
						getValueJson = as.rajaongkir.results[0].costs[i].cost[0].value;
						DEF = true;
						break;
					}	
				}

				if(DEF == false){
					$('#tr_ongkir').html("<td colspan='2' class='kanan'><b>Ongkir</b></td><td class='kanan' id='loading'><b>"+
								"Tidak tersedia</b></td>");
					$("#tr_sub_total").html("<td colspan='2' class='kanan'><b>Sub Total</b></td><td class='kanan'><b>"+
							rupiah(<?= $subtotal; ?>)+"</b></td>");
				}else{
					var cost_ongkir = getValueJson;
					var sub_total = parseInt("<?= $subtotal; ?>");
					var jml_sub_total = cost_ongkir+sub_total;
					
					$('#tr_ongkir').html("<td colspan='2' class='kanan'><b>Ongkir ("+kurir+")</b></td><td class='kanan'><b id='val_ongkir' value="+cost_ongkir+">"+
										rupiah(cost_ongkir)+"</b></td><input type='hidden' name='val_ongkir_cost' id='val_ongkir_cost' value="+cost_ongkir+">");
					
					$("#tr_sub_total").html("<td colspan='2' class='kanan'><b>Sub Total</b></td><td class='kanan'><b>"+
										rupiah(jml_sub_total)+"</b></td>");
				}
			}
        });
	}
	function rupiah(angka){
		var reverse = angka.toString().split('').reverse().join(''),
		ribuan = reverse.match(/\d{1,3}/g);
		ribuan = ribuan.join(',').split('').reverse().join('');
		return "Rp,"+ribuan;
	}
});
</script>

<style>
/* ini yg radio */
.pureCSS input[type=radio]:not(old){
  width     : 2em;
  margin    : 0;
  padding   : 0;
  font-size : 1em;
  opacity   : 0;
  cursor: pointer;
}
.pureCSS input[type=radio]:not(old) + label{
  display      : inline-block;
  /* margin-left  : -2em; */
  line-height  : 1.5em;
  cursor: pointer;
}
.pureCSS input[type=radio]:not(old) + label > span{
  display          : inline-block;
  width            : 0.875em;
  height           : 0.875em;
  margin           : 0.25em 0.5em 0.25em 0.25em;
  border           : 0.0625em solid rgb(192,192,192);
  border-radius    : 0.25em;
  background       : rgb(224,224,224);
  background-image :    -moz-linear-gradient(rgb(240,240,240),rgb(224,224,224));
  background-image :     -ms-linear-gradient(rgb(240,240,240),rgb(224,224,224));
  background-image :      -o-linear-gradient(rgb(240,240,240),rgb(224,224,224));
  background-image : -webkit-linear-gradient(rgb(240,240,240),rgb(224,224,224));
  background-image :         linear-gradient(rgb(240,240,240),rgb(224,224,224));
  vertical-align   : bottom;
}
.pureCSS input[type=radio]:not(old):checked + label > span{
  background-image :    -moz-linear-gradient(rgb(224,224,224),rgb(240,240,240));
  background-image :     -ms-linear-gradient(rgb(224,224,224),rgb(240,240,240));
  background-image :      -o-linear-gradient(rgb(224,224,224),rgb(240,240,240));
  background-image : -webkit-linear-gradient(rgb(224,224,224),rgb(240,240,240));
  background-image :         linear-gradient(rgb(224,224,224),rgb(240,240,240));
}
.pureCSS input[type=radio]:not(old):checked +  label > span > span{
  display          : block;
  width            : 0.5em;
  height           : 0.5em;
  margin           : 0.125em;
  border           : 0.0625em solid rgb(115,153,77);
  border-radius    : 0.125em;
  background       : rgb(153,204,102);
  background-image :    -moz-linear-gradient(rgb(179,217,140),rgb(153,204,102));
  background-image :     -ms-linear-gradient(rgb(179,217,140),rgb(153,204,102));
  background-image :      -o-linear-gradient(rgb(179,217,140),rgb(153,204,102));
  background-image : -webkit-linear-gradient(rgb(179,217,140),rgb(153,204,102));
  background-image :         linear-gradient(rgb(179,217,140),rgb(153,204,102));
}
</style>	


