<?php
ob_start();
$srvr = "localhost";
$usr = "root";
$pswd = "";
$dtbs = "keyman";

$con = mysql_connect($srvr,$usr,$pswd);
if(!$con){
	die("Tidak bisa terhubung dengan database".mysql_error());
}
mysql_select_db($dtbs,$con);

?>