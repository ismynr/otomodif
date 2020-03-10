<?php
	if($user_id){
		header("Location: ".BASE_URL."index.php");
    }
    
    // IF USER CLICK SUBMIT BUTTON LOGIN
    if(isset($_POST["login"])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        
        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email' AND password='$password' AND status='Aktif' AND remove=0");
        
        if(mysqli_num_rows($query) == 0){
            // DEFINITION SESSION flash_alert
            $_SESSION['flash_alert'] = "<div class=\"alert alert-danger\" role=\"alert\"><strong>Gagal!</strong> Email atau Password yang anda masukkan salah.</div>";
        }else{
            $row = mysqli_fetch_assoc($query);
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['nama']    = $row['nama'];
            $_SESSION['level']   = $row['level'];
            $id = $_SESSION['id_user'];
            $level = $_SESSION['level'];

            // UPDATE LAST LOGIN
            mysqli_query($koneksi, "UPDATE user SET logged_at =  CURRENT_TIMESTAMP WHERE id_user='$id'");
            log__a($_SESSION['id_user'], "login", ['level'=>$_SESSION['level']]);

            // CHECKED USER LEVEL / ROLE
            if($level == "Customer"){
                if(isset($_SESSION["proses_pesanan"])){
                    unset($_SESSION["proses_pesanan"]);
                    header("location: ".BASE_URL."index.php?page=checkout");
                }else{
                    header("location: ".BASE_URL."");
                }
            }else if($level == "SuperAdmin"){
                header("location: ".BASE_URL."admin");
            }else{
                header("location: ".BASE_URL."index.php?page=login");
            }
        }
    }
    
?>

<div class="container-fluid" id="container-user-akses">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="font-weight-bold mb-4">MASUK</h3>
            <form action="" class="was-validated" method="POST">
                <?php 
                    // IF DEFINITION SESSION flash_alert AVAILABLE
                    if(isset($_SESSION['flash_alert'])){
                        echo $_SESSION['flash_alert'];
                        unset($_SESSION['flash_alert']);
                    }
                ?>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Masukkan Email" name="email" required>
                    <div class="valid-feedback">Benar.</div>
                    <div class="invalid-feedback">Silahkan isi Email dengan benar.</div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Masukkan Password" name="password" required>
                    <div class="valid-feedback">Benar.</div>
                    <div class="invalid-feedback">Silahkan isi Password dengan benar.</div>
                </div>
                <button type="submit" value="login" name="login" class="btn btn-danger">Masuk</button>
                <span class="ml-3">Belum punya akun? <a href='/otomodif/index.php?page=register'><b>Daftar</b></a></span>
            </form>
        </div>
    </div>
</div>

