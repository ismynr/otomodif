<?php
	
    $pesanan_id= $_GET["pesanan_id"];
    $query = "SELECT pesanan.tanggal_pemesanan, pesanan.status, pesanan.ongkir, pesanan.kota_tujuan, pesanan.kurir, user.nama AS nama_user, alamat_pengiriman.nama AS nama_alamat, alamat_pengiriman.no_hp, alamat_pengiriman.alamat, desa.desa_nama, kecamatan.kecamatan_nama, kabupaten_kota.kabupaten_nama, provinsi.provinsi_nama
                FROM pesanan 
                JOIN user ON pesanan.id_user=user.id_user 
                JOIN alamat_pengiriman ON alamat_pengiriman.id_alamat=pesanan.alamat_pengiriman 
                JOIN desa ON desa.desa_id=alamat_pengiriman.desa
                JOIN kecamatan ON kecamatan.kecamatan_id=alamat_pengiriman.kecamatan
                JOIN kabupaten_kota ON kabupaten_kota.kabupaten_id=alamat_pengiriman.kabupaten_kota
                JOIN provinsi ON provinsi.provinsi_id=alamat_pengiriman.provinsi
                WHERE pesanan.id_pesanan='$pesanan_id'";
	
	// $query = mysqli_query($koneksi, "SELECT pesanan.nama_penerima, pesanan.nomor_telepon, pesanan.alamat, pesanan.tanggal_pemesanan, user.nama, kota.kota, kota.tarif FROM pesanan JOIN user ON pesanan.id_user=user.id_user JOIN kota ON kota.id_kota=pesanan.id_kota WHERE pesanan.id_pesanan='$pesanan_id'");
	
    // $row=mysqli_fetch_assoc($query);
    
    $statementUser = $connection->prepare($query);
    $statementUser->execute();
    $row = $statementUser->fetch();
	
	$tanggal_pemesanan = $row['tanggal_pemesanan'];
	$nama_penerima = $row['nama_alamat'];
	$nomor_telepon = $row['no_hp'];
    $alamat = $row['alamat'];
    $status = $row['status'];
	$tarif = $row['ongkir'];
	$kurir = $row['kurir'];
	$kota_tujuan = $row['kota_tujuan'];
	$nama = $row['nama_user'];
	$desa = $row['desa_nama'];
	$kecamatan = $row['kecamatan_nama'];
	$kabupaten = $row['kabupaten_nama'];
	$provinsi = $row['provinsi_nama'];
	
?>

<div class="card-header">
    <div class="col-md-6">
        <h3 class="card-title">Detail Pesanan</h3>
    </div>
</div>
<!-- /.card-header -->
<div class="card-body">
    <table class="mb-3">
        <tr>
            <td>ID Pesanan</td>
            <td>:</td>
            <td><?php echo $pesanan_id; ?></td>
        </tr>
        <tr>
            <td>Nama Pembeli</td>
            <td>:</td>
            <td><?php echo $nama; ?></td>
        </tr>
        <tr>
            <td>Nama Penerima</td>
            <td>:</td>
            <td><?php echo $nama_penerima; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?php echo $alamat; ?></td>
        </tr>
        <tr>
            <td></td>
            <td>:</td>
            <td><?php echo $desa .' - '. $kecamatan .' - '. $kabupaten .' - '. $provinsi; ?></td>
        </tr>
        <tr>
            <td>Kota Tujuan</td>
            <td>:</td>
            <td><?php echo $kota_tujuan; ?></td>
        </tr>	
        <tr>
            <td>Nomor Telepon</td>
            <td>:</td>
            <td><?php echo $nomor_telepon; ?></td>
        </tr>
        <tr>
            <td>Tarif Pengiriman</td>
            <td>:</td>
            <td><?php echo $tarif; ?></td>
        </tr>		
        <tr>
            <td>Kurir</td>
            <td>:</td>
            <td><?php echo $kurir; ?></td>
        </tr>
        <tr>
            <td>Tanggal Pemesanan</td>
            <td>:</td>
            <td><?php echo $tanggal_pemesanan; ?></td>
        </tr>
        <tr>
            <td>Tanggal Pemesanan</td>
            <td>:</td>
            <td><?php echo $tanggal_pemesanan; ?></td>
        </tr>
        <tr>
            <td>Status Pemesanan</td>
            <td>:</td>
            <td><span class="text-success"><?php echo $arrayStatusPesanan[$status]; ?></span></td>
        </tr>	
        <tr>
            <td>Ubah Status Pemesanan  </td>
            <td>:</td>
            <td>
                <div class="mt-2 continer">
                    <div class="row">
                        <div class="col-md-6">
                        <select class="form-control" id="statusPesanan">
                            <?php $no = 0; ?>
                            <?php foreach($arrayStatusPesanan as $rowsp): ?>
                                <option value="<?= $no; ?>"><?= $rowsp; ?></option>
                                <?php $no++ ?>
                            <?php endforeach; ?>
                        </select>
                        </div>
                        <div class="col-md-6"><button onclick="simpan()" class="ml-1 btn btn-success">Simpan</button> </div>
                    </div>
                </div>
            </td>
        </tr>	
    </table>


    <table class='table table-bordered table-striped table-hover'>
		<tr class="baris-title">
			<th class="no">No</th>
			<th class="kiri">Nama Barang</th>
			<th class="tengah">Qty</th>
			<th class="kanan">Harga Satuan</th>
			<th class="kanan">Total</th>
		</tr>
		
		<?php
		
			$queryDetail = mysqli_query($koneksi, "SELECT detail_pesanan.*, barang.nama_barang FROM detail_pesanan JOIN barang ON detail_pesanan.id_barang=barang.id_barang WHERE detail_pesanan.id_pesanan='$pesanan_id'");
			
			$no = 1;
			$subtotal = 0;
			while($rowDetail=mysqli_fetch_assoc($queryDetail)){
			
				$total = $rowDetail["harga"] * $rowDetail["quantity"];
				$subtotal = $subtotal + $total;
				
				echo "<tr>
						<td class='no'>$no</td>
						<td class='kiri'>$rowDetail[nama_barang]</td>
						<td class='tengah'>$rowDetail[quantity]</td>
						<td class='kanan'>".rupiah($rowDetail["harga"])."</td>
						<td class='kanan'>".rupiah($total)."</td>
					  </tr>";
				
				$no++;
			}
		
			$subtotal = $subtotal + $tarif;
		?>
		
		<tr>
			<td class="kanan" colspan="4">Biaya Pengiriman (<?= $kurir; ?>)</td>
			<td class="kanan"><?php echo rupiah($tarif); ?></td>
		</tr>

		<tr>
			<td class="kanan" colspan="4"><b>Sub total</b></td>
			<td class="kanan"><b><?php echo rupiah($subtotal); ?></b></td>
		</tr>
		
	</table>
</div>

<script>
function simpan(){
    var status = $("#statusPesanan").val();
	$.ajax({
		method: "POST",
		url: "<?= BASE_URL; ?>admin/pages/pesanan/simpan_status_pesanan.php",
		data: "id_pesanan=<?= $pesanan_id; ?>&status="+status
	})
	.done(function(data){
        alert(data);
		location.reload();
	});
}
</script>