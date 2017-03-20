<?php
	include "session.php";
	include "koneksi.php";
	$user = $userOnSession;
	$tipe = $_POST['tipe'];
	$id = $_POST['id'];
	
	// update data ke database
    mysql_query("UPDATE catatan SET favorit='".$tipe."' WHERE username='".$user['username']."' AND id='".$id."'",$connection) or die(mysql_error());
    mysql_close($connection);
?>