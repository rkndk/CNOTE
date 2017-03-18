<?php
session_start();
$error="";
if(isset($_SESSION['user'])){
	header("location: home.php");
}
else if (isset($_POST['submit'])) {
	// Variabel 
	$username=$_POST['username'];
	$password1=$_POST['password1'];
	$password2=$_POST['password2'];
	$email=$_POST['email'];
	$nama=$_POST['nama'];

	if($password1!=$password2){
		$error="Password tidak sama";
	}
	else{
		// Membangun koneksi ke database
		$connection = mysql_connect("localhost", "root", "");
		// Seleksi Database
		$db = mysql_select_db("cnote", $connection);
		// SQL query untuk memeriksa apakah user terdapat di database?
		$query = mysql_query("select username from user where username='$username'", $connection);
		$rows = mysql_num_rows($query);
		if ($rows >= 1) {
			$error="Username telah terdaftar";
		}
		else
		{
			// Mencegah MySQL injection 
			$username = stripslashes($username);
			$password1 = stripslashes($password1);
			$email = stripslashes($email);
			$nama = stripslashes($nama);
			$username = mysql_real_escape_string($username);
			$password1 = mysql_real_escape_string($password1);
			$email = mysql_real_escape_string($email);
			$nama = mysql_real_escape_string($nama);
			// SQL query untuk memasukkan data ke database
			mysql_query("insert into user(username,password,nama,email)  values('".$username."','".md5($password1)."','".$nama."','".$email."')", $connection);
			$_SESSION['user']=$username; // Membuat Sesi/session
			header("location: home.php");
		}
		mysql_close($connection); // Menutup koneksi
	}
}
?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>CNOTE - Daftar </title>    
    <link rel="stylesheet" href="assets/css/form-style.css">
  </head>

  <body>
    <div class="container">
      <div id="enter">
        <div id="signup-form">
            <div id="judul">
              SIGN UP
            </div>
            <div id="content">
              <form action="daftar.php" method="post" role="form">
                <span class="form-label">Nama</span>
                <div id="form-login-username" class="input-group">
                  <input id="nama" class="input-field" name="nama" type="text" size="18" alt="nama" required />
                </div>
                <span class="form-label">Username</span>
                <div id="form-login-username" class="input-group">
                  <input id="username" class="input-field" name="username" type="text" size="18" alt="username" required />
                </div>
                <span class="form-label">Email</span>
                <div id="form-login-username" class="input-group">
                  <input id="email" class="input-field" name="email" type="email" size="18" alt="email" required />
                </div>
                <span class="form-label">Password</span>
                <div id="form-login-password" class="input-group">
                  <input id="password1" class="input-field" name="password1" type="password" size="18" alt="password"  required>
                </div>
                <span class="form-label">Konfirmasi Password</span>
                <div id="form-login-password" class="input-group">
                  <input id="password2" class="input-field" name="password2" type="password" size="18" alt="password"  required>
                </div>
                <center><span class="form-label" style="color: #F44336;"><?php echo $error ?></span></center>
                <div id="submit-buton" class="input-group submit">
                    <input class="btn btn-ok input-field" type="submit" name="submit" alt="daftar" value="DAFTAR">
                </div>
              </form>
              <center><span id="footer-signup" class="form-label signup">Sudah punya akun cnote? <a class="form-label signup" href="masuk.php"> <b> MASUK</b></span></center>
            </div>
            <div id="footer"></div>
        </div>  
      </div>
    </div>
  </body>
</html>