<?php
ob_start();
setcookie('sks','',time()+3600*24*30);
include 'nyambung.php';
$query = mysql_query("SELECT id_jadwal FROM jadwal ORDER BY id_jadwal");
while ($data = mysql_fetch_array($query)){
	if (isset($_COOKIE['id'.$data['id_jadwal']])) {
		setcookie('id'.$data['id_jadwal'],'',time()+3600*24*30);
	}
}
header('location: index.php');
ob_end_flush();
?>