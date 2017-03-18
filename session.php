<?php
// Memulai Session
session_start();
if(!isset($_SESSION['user'])){
	header('Location: masuk.php');
}
else{
	// Membangun Koneksi dengan Server dengan nama server, username dan password sebagai parameter
	$connection = mysql_connect("localhost", "root", "");

	// Seleksi Database
	$db = mysql_select_db("cnote", $connection);
	// user cek
	$userCheck = $_SESSION['user'];
	// Ambil username dengan mysql_fetch_assoc
	$ses_sql=mysql_query("select * from user where username='$userCheck'", $connection);
	$userOnSession = mysql_fetch_assoc($ses_sql);
}
?>