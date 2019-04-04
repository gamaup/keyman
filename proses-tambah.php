<?php
ob_start();
$id = $_GET['id'];
$sks = $_GET['sks'];
setcookie('id'.$id,$id,time()+3600*24*30);
$cursks = $_COOKIE['sks'];
$cursks2 = $cursks - $sks;
setcookie('sks',$cursks2,time()+3600*24*30);
ob_end_flush();
?>