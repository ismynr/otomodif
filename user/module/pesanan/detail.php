<?php
	
	$pesanan_id= $_GET["pesanan_id"];
	
	// $query = mysqli_query($koneksi, "SELECT pesanan.nama_penerima, pesanan.nomor_telepon, pesanan.alamat, pesanan.tanggal_pemesanan, pesanan.status, user.nama, kota.kota, kota.tarif FROM pesanan JOIN user ON pesanan.id_user=user.id_user JOIN kota ON kota.id_kota=pesanan.id_kota WHERE pesanan.id_pesanan='$pesanan_id'");
	$query = mysqli_query($koneksi, "SELECT pesanan.tanggal_pemesanan, pesanan.status, pesanan.ongkir, pesanan.kota_tujuan, pesanan.kurir, user.nama AS nama_user, alamat_pengiriman.nama AS nama_alamat, alamat_pengiriman.no_hp, alamat_pengiriman.alamat, desa.desa_nama, kecamatan.kecamatan_nama, kabupaten_kota.kabupaten_nama, provinsi.provinsi_nama
										FROM pesanan 
										JOIN user ON pesanan.id_user=user.id_user 
										JOIN alamat_pengiriman ON alamat_pengiriman.id_alamat=pesanan.alamat_pengiriman 
										JOIN desa ON desa.desa_id=alamat_pengiriman.desa
										JOIN kecamatan ON kecamatan.kecamatan_id=alamat_pengiriman.kecamatan
										JOIN kabupaten_kota ON kabupaten_kota.kabupaten_id=alamat_pengiriman.kabupaten_kota
										JOIN provinsi ON provinsi.provinsi_id=alamat_pengiriman.provinsi
										WHERE pesanan.id_pesanan='$pesanan_id'");
	$row=mysqli_fetch_assoc($query);

	// $row = mysqli_fetch_array($query,MYSQLI_ASSOC);

	
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

    // $kota = $row['kota'];
    // $kota = $row['kota'];
	
?>

<div id="frame-faktur">

	<h3><center>DETAIL PESANAN</center></h3>
	
	<hr/>
	
	<table>
	
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
	</table>	
</div>	
<br><br>
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
	<?php 
	$queryKp = mysqli_query($koneksi, "SELECT * FROM konfirmasi_pembayaran WHERE id_pesanan='$pesanan_id'");
	$jmlKp = mysqli_num_rows($queryKp);
	?>
	
	<?php if($status == 0 || $status == 3): ?>
		<a href='<?= BASE_URL; ?>user/index.php?page=pesanan&module=pesanan&action=batalkan&pesanan_id=<?= $pesanan_id; ?>' class='btn btn-danger' role='button' title='Batalkan Pesanan'></i>Batalkan Pesanan</a>
	<?php endif; ?>

	<?php if($status != 5 && $status != 6): ?>
	<?php if($jmlKp == 0): ?>
        <div id="frame-keterangan-pembayaran">
            <p>* Silahkan Lakukan pembayaran ke Bank BRI<br/>
            * Nomor Account : 0000-1111-2222 (A/N OTOMODIF Sparepart).<br/>
            * Jika sudah membayar silahkan lakukan konfirmasi pembayaran 
            <a href="<?php echo BASE_URL."user/index.php?page=pesanan&module=pesanan&action=konfirmasi_pembayaran&pesanan_id=$pesanan_id"?>">Disini</a>
            </p>
        </div>
	<?php endif; ?>
    <?php endif; ?>
	<hr/>
	<h3><center>OTOMODIF</center></h3>