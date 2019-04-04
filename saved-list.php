<?php
require_once 'nyambung.php';
$nim = $_COOKIE['nim'];
$query_saved = mysql_query("SELECT * FROM simpan WHERE nim = $nim ORDER BY ke") or die(mysql_error());
while ($hasil_saved = mysql_fetch_array($query_saved)) {
	echo "<li>
					<div class='tombols'>
						<a class='button' target='_blank' href='jadwal/".$hasil_saved['path']."'><i class='fa fa-share-square-o'></i></a>
						<a class='button' href='proses-simpan2.php?img=jadwal/".$hasil_saved['path']."'><i class='fa fa-download'></i></a>
					</div>
					<span class='tanggal'>".$hasil_saved['tanggal']."</span>
					<span class='nama'>".$hasil_saved['nim']."-".$hasil_saved['ke']."</span>
				</li>";
} 

?>