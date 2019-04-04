<?php
$id = $_GET['id'];
$sks = $_GET['sks'];
setcookie('id'.$id,'',time()+3600*24*30);
$cursks = $_COOKIE['sks'];
$cursks = $cursks + $sks;
setcookie('sks',$cursks,time()+3600*24*30);
echo $_COOKIE['sks'];
?>