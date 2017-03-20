<?php
	include "session.php";
	include "koneksi.php";
	$user = $userOnSession;

	if(isset($_POST['tipe'])){
		$tipe = $_POST['tipe'];

		if($tipe=="hapus"){
			$id = $_POST['id'];
			for($i=0; $i<count($id); $i++){
				mysql_query("DELETE from catatan WHERE id='".$id[$i]."'",$connection) or die(mysql_error());
			}
		}
		else if($tipe=="edit"){
			$id = $_POST['id'];
			$judul = $_POST['judul'];
			$isi = $_POST['catatan'];
			$tanggal = date("Y-m-d");
			// update data ke database
    		mysql_query("UPDATE catatan SET judul='".$judul."', isi='".$isi."', tanggal='".$tanggal."' WHERE id='".$id."'",$connection) or die(mysql_error());
    		header("location: home.php?status=sukses");
		}
	}
    mysql_close($connection);
?>