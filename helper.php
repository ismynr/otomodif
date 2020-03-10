<?php

	define("BASE_URL", "http://localhost/otomodif/");
	define("APP_NAME", "Otomodif");
	
	$arrayStatusPesanan[0] = "Menunggu Pembayaran";
	$arrayStatusPesanan[1] = "Pembayaran Sedang Di Validasi";
	$arrayStatusPesanan[2] = "Lunas, Menunggu Pengiriman";
	$arrayStatusPesanan[3] = "Pembayaran Di Tolak";
	$arrayStatusPesanan[4] = "Proses Pengiriman";
	$arrayStatusPesanan[5] = "Selesai";
	$arrayStatusPesanan[6] = "Transaksi Dibatalkan";
	
	function rupiah($nilai = 0){
		$string = "Rp," . number_format($nilai);
		return $string;
	}
	
	function kategori($id_kategori = false){
		global $koneksi;
		
		$string = "<div id='menu-kategori'>";
			
			$string .= "<ul>";
				
					$query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE status='Publish'");
					$string .= "<li><a href='".BASE_URL."index.php' class='active'>All</a></li>";
					while($row=mysqli_fetch_assoc($query)){
						if($id_kategori == $row['id_kat']){
							$string .= "<li><a href='".BASE_URL."index.php?id_kategori=$row[id_kat]' class='active'>$row[kategori]</a></li>";
						}else{
							$string .= "<li><a href='".BASE_URL."index.php?id_kategori=$row[id_kat]'>$row[kategori]</a></li>";
						}
					}
			
			$string .= "</ul>";
		
		$string .= "</div>";		
		
		return $string;
	}

	function get_total_all_records($table, $where) {
		include('db.php');
		$statement = $connection->prepare("SELECT * FROM $table $where");
		$statement->execute();
		$result = $statement->fetchAll();
		return $statement->rowCount();
	}

	function upload_image() {
		if(isset($_FILES["gambar"])) {
			$gambar = explode('.', $_FILES['gambar']['name']);
			$new_name = rand() . '.' . $gambar[1];
			$destination = '../../../uploads/barang/' . $new_name;
			move_uploaded_file($_FILES['gambar']['tmp_name'], $destination);
			return $new_name;
		}
	}

	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	function log__a($id_user, $process, $item){
		$connection = new PDO( 'mysql:host=localhost;dbname=phbweb2_otomodif', 'root','');

		$statement = $connection->prepare("
            INSERT INTO log_aktifitas (id_user, process, item, ip_address) 
            VALUES (:id_user, :process, :item, :ip_address)
        ");
        $result = 
            array(
                ':id_user' => $id_user,
				':process' => $process,
				':item' => json_encode($item),	
				':ip_address' => get_client_ip()		
			);
		$statement->execute($result);
	}
	
