<?php
	session_start();
  $error="";
	if(isset($_SESSION['user'])){
		header("location: home.php");
	}
	else if (isset($_POST['submit'])) {
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Username or Password tidak valid";
		}
		else
		{
			// Variabel username dan password
			$username=$_POST['username'];
			$password=$_POST['password'];
			// Membangun koneksi ke database
			$connection = mysql_connect("localhost", "root", "");
			// Mencegah MySQL injection 
			$username = stripslashes($username);
			$password = stripslashes($password);
			$username = mysql_real_escape_string($username);
			$password = mysql_real_escape_string($password);
			// Seleksi Database
			$db = mysql_select_db("cnote", $connection);
			// SQL query untuk memeriksa apakah user terdapat di database?
			$query = mysql_query("select * from user where username='$username' AND password='".md5($password)."'", $connection);
			$rows = mysql_num_rows($query);
			if ($rows == 1) {
				$_SESSION['user']=$username; // Membuat Sesi/session
				header("location: home.php"); // Mengarahkan ke halaman profil
			}
			else {
				$error = "username atau password salah";
			}
			mysql_close($connection); // Menutup koneksi
		}
	}
?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>CNOTE - Masuk </title>    
    <link rel="stylesheet" href="assets/css/form-style.css">
  </head>

  <body>
    <div class="container">
      <div id="enter">
        <div id="login-form">
            <div id="judul">
              LOG IN
            </div>
            <div id="content">
              <form action="masuk.php" method="post" role="form">
                <span class="form-label">Username</span>
                <div id="form-login-username" class="input-group">
                  <input id="username" class="input-field" name="username" type="text" size="18" alt="username" required />
                </div>
                <span class="form-label">Password</span>
                <div id="form-login-password" class="input-group">
                  <input id="password" class="input-field" name="password" type="password" size="18" alt="password"  required>
                </div>
                <center><span class="form-label" style="color: #F44336;"><?php echo $error ?></span></center>
                <div id="submit-buton" class="input-group submit">
                    <input class="btn btn-ok input-field" type="submit" name="submit" alt="masuk" value="MASUK">
                </div>
              </form>
              <center><span id="footer-login" class="form-label signup">Tidak punya akun cnote? <a class="form-label signup" href="daftar.php"> <b> DAFTAR</b></a></span></center>
            </div>
            <div id="footer"></div>
        </div> 
      </div>
    </div>
  </body>
</html>