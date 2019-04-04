<?php
ini_set('max_execution_time', 0);
include "nyambung.php";
$query = mysql_query("SELECT COUNT('id_makul') FROM makul");
$jumlah = mysql_result($query, 0);
$query2 = mysql_query("SELECT id_makul FROM makul ORDER BY id_makul");
$a=1;
while($data = mysql_fetch_row($query2)){
	$id[$a] = $data[0];
	$a++;
}

for ($i=1;$i<=$jumlah;$i++){
	if (isset($_POST[$id[$i]])) {
		$cek[$i] = "";
	} else {
		$cek[$i] = "ora";
	}
	$sort[$id[$i]] = $cek[$i];
}

setcookie('sort', serialize($sort), time()+3600*24*30);

header('location: index.php');
?>