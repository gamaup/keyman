<?php
	include 'nyambung.php';

	$image = $_POST['file'];
	$nim = $_COOKIE['nim'];
	$query_next = mysql_query("SELECT ke FROM simpan WHERE nim = $nim ORDER BY ke DESC");
	if (mysql_num_rows($query_next) != 0) {
		$hasil_next = mysql_result($query_next, 0);
		$next = $hasil_next+1;
	} else {
		$next = 1;
	}
	date_default_timezone_set('Asia/Bangkok');
	$tanggal = date('d-m-y H:i');
	
    $decoded = str_replace('data:image/png;base64,','',$image);
    $name = "keyman-".$nim."-".$next.".png";
    file_put_contents("jadwal/".$name , file_get_contents($image));
    echo $name;

    $query = "INSERT INTO simpan ( nim, ke, path, tanggal) VALUES ($nim, $next, '$name', '$tanggal')";
	$hasil = mysql_query($query) or die("Error".mysql_error());
 //    header('Content-Description: File Transfer');
	// header("Content-type: image/jpg");
	// header("Content-disposition: attachment; filename= ".$name.".png");
	//readfile($name);
?>