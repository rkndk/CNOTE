<?php
//File koneksi ke database
$hostServer="localhost";
$usernameServer="root";
$passwordServer="";
$databaseServer="cnote";

//Koneksi ke host
$connection = mysql_connect($hostServer,$usernameServer,$passwordServer) or die("Maaf, Server Mati");

//Select database
$db = mysql_select_db($databaseServer, $connection) or die("Database tidak ada");
?>
