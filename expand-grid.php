<?php
ob_start();
include('nyambung.php');

function floattojam($jam) {
	$jam1 = $jam - floor($jam);
	$jam2 = round($jam1*60);
	if (floor($jam)<10) {
		$jam3 = '0'.floor($jam);
	} else {
		$jam3 = floor($jam);
	}
	if ($jam2<10){
		$jam4 = '0'.$jam2;
	} else {
		$jam4 = $jam2;
	}
	$jama = $jam3.'.'.$jam4;
	return $jama;
}
echo '<div id="expand-grid">';
$hari = array('senin','selasa','rabu','kamis','jumat','sabtu');
for ($h=0;$h<6;$h++){
	echo "<div class='ex-jadwal-box'>
		<div class='ex-jadwal-box-head'>
			".$hari[$h]."
		</div>
		<ul>";
	$querycookie[$h] = mysql_query("SELECT id_jadwal, jam_mulai FROM jadwal ORDER BY jam_mulai");
	$c = 1;
	while ($datacookie[$h] = mysql_fetch_array($querycookie[$h])){
		$idcookie[$h][$c] = $datacookie[$h]['id_jadwal'];
		if(isset($_COOKIE['id'.$idcookie[$h][$c]])) {
			$id_cookie[$h][$c] = $_COOKIE['id'.$idcookie[$h][$c]];
		} else {
			$id_cookie[$h][$c] = 0;
		}
		$queryjadwal[$h][$c] = mysql_query("SELECT j.id_jadwal, m.id_makul, m.makul, j.dosen, j.hari, j.jam_mulai, j.jam_selesai, m.sks, j.kelas
			FROM makul m
			INNER JOIN jadwal j
			    on m.id_makul = j.id_makul
			WHERE j.hari = '".$hari[$h]."' AND j.id_jadwal = ".$id_cookie[$h][$c]."
			ORDER BY j.jam_mulai");
		$b = 1;
		while($datajadwal[$h][$c] = mysql_fetch_row($queryjadwal[$h][$c])){
			$id_jadwal[$h][$c][$b] = $datajadwal[$h][$c][0];
			$sks[$h][$c][$b] = $datajadwal[$h][$c][7];
			$jam_mulai[$h][$c][$b] = floattojam($datajadwal[$h][$c][5]);
			$jam_selesai[$h][$c][$b] = floattojam($datajadwal[$h][$c][6]);
			echo "
			<li>
				<div class='kelas'>
				".$datajadwal[$h][$c][8]."
				</div>
				<div class='jadwal'>
					<h4>".$datajadwal[$h][$c][2]."</h4>
					<h5>".$datajadwal[$h][$c][3]."</h5>
				</div>
				<div class='jam'>
					".$jam_mulai[$h][$c][$b]."<br/>".$jam_selesai[$h][$c][$b]."
				</div>
			</li>
			";
		}			
		$c++;
	}
	echo "
	</ul>
</div>
	";
}
echo '</div>';
ob_end_flush();
?>