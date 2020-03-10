<?php
    
	$queryPesanan = mysqli_query($koneksi, "SELECT pesanan.*, user.nama FROM pesanan JOIN user ON pesanan.id_user=user.id_user WHERE pesanan.id_user='$user_id' AND pesanan.status<=4 AND pesanan.remove=0 ORDER BY pesanan.tanggal_pemesanan DESC");
	
	if(mysqli_num_rows($queryPesanan) == 0){
		echo "<h3>Saat ini belum ada data pesanan</h3>";
	}
	else{
			
		echo "<h3><b>PESANAN ANDA</b></h3>";
		echo "<table class='table table-bordered table-striped table-hover'>
				<tr class='baris-title'>
					<th class='kiri'>ID Pesanan</th>
					<th class='tengah'>Status Pesanan</th>
					<th class='tengah'>Nama Pembeli</th>
					<th class='tengah'>Aksi</th>
				</tr>";
		
		$adminButton = "";
		while($row=mysqli_fetch_assoc($queryPesanan)){
			
			$querySelect = mysqli_query($koneksi, "SELECT * FROM konfirmasi_pembayaran WHERE id_pesanan='$row[id_pesanan]'");
			$hasil = mysqli_num_rows($querySelect) == 0 ? "" : "<a href='".BASE_URL."user/index.php?page=pesanan&module=pesanan&action=rekening&pesanan_id=$row[id_pesanan]' class='btn btn-success' role='button' title='Rekening Pembayaran Pesanan'></i>Rekening</a>";

			$status = $row['status'];
			echo "<tr>
					<td class='kiri'>$row[id_pesanan]</td>
					<td class='kiri'>$arrayStatusPesanan[$status]</td>
					<td class='kiri'>$row[nama]</td>
					<td class='tengah'>
						<a href='".BASE_URL."user/index.php?page=pesanan&module=pesanan&action=detail&pesanan_id=$row[id_pesanan]' class='btn btn-dark' role='button' title='Detail Pesanan'></i>Detail</a>
						".$hasil."
					</td>
				 </tr>";
		}
		
		echo "</table>";
	}
	
?>