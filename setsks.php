<?php
ob_start();
$sksasli = $_POST['sks'];
$sks = str_replace(" ", "", $sksasli);
$nimasli = $_POST['nim'];
$nim = str_replace(" ", "", $nimasli);
setcookie('sks',$sks,time()+3600*24*30);
setcookie('nim',$nim,time()+3600*24*30);
echo $sks;
echo $nim;
ob_end_flush();
?> 