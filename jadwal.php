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

$hari = array('senin','selasa','rabu','kamis','jumat','sabtu');
for ($h=0;$h<6;$h++){
	echo "<div class='jadwal-box-wrapper'>
	<div class='jadwal-box'>
		<div class='head'>
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
				<div title='Hapus Jadwal' class='hapusjadwal' data-id='".$id_jadwal[$h][$c][$b]."' data-sks='".$sks[$h][$c][$b]."'><p>Hapus Jadwal</p></div>
			</li>
			";
		}			
		$c++;
	}
	echo "
	</ul>
	</div>
</div>
	";
}
?>
<div id="minggu-overlay">
<div id="jadwal-minggu" class='jadwal-box'>
	<div class='head'>
		Minggu
	</div>
	<ul>
		<?php
		$querycookieminggu = mysql_query("SELECT id_jadwal, jam_mulai FROM jadwal ORDER BY jam_mulai");
		$c = 1;
		while ($datacookieminggu = mysql_fetch_array($querycookieminggu)){
			$idcookieminggu[$c] = $datacookieminggu['id_jadwal'];
			if(isset($_COOKIE['id'.$idcookieminggu[$c]])) {
				$id_cookieminggu[$c] = $_COOKIE['id'.$idcookieminggu[$c]];
			} else {
				$id_cookieminggu[$c] = 0;
			}
			$queryjadwalminggu[$c] = mysql_query("SELECT j.id_jadwal, m.id_makul, m.makul, j.dosen, j.hari, j.jam_mulai, j.jam_selesai, m.sks, j.kelas
				FROM makul m
				INNER JOIN jadwal j
				    on m.id_makul = j.id_makul
				WHERE j.hari = 'minggu' AND j.id_jadwal = ".$id_cookieminggu[$c]."
				ORDER BY j.jam_mulai");
			$b = 1;
			while($datajadwalminggu[$c] = mysql_fetch_row($queryjadwalminggu[$c])){
				$id_jadwalminggu[$c][$b] = $datajadwalminggu[$c][0];
				$sksminggu[$c][$b] = $datajadwalminggu[$c][7];
				$jam_mulaiminggu[$c][$b] = floattojam($datajadwalminggu[$c][5]);
				$jam_selesaiminggu[$c][$b] = floattojam($datajadwalminggu[$c][6]);
				echo "
				<li>
					<div class='kelas'>
					".$datajadwalminggu[$c][8]."
					</div>
					<div class='jadwal'>
						<h4>".$datajadwalminggu[$c][2]."</h4>
						<h5>".$datajadwalminggu[$c][3]."</h5>
					</div>
					<div class='jam'>
						".$jam_mulaiminggu[$c][$b]."<br/>".$jam_selesaiminggu[$c][$b]."
					</div>
					<div title='Hapus Jadwal' class='hapusjadwal' data-id='".$id_jadwalminggu[$c][$b]."' data-sks='".$sksminggu[$c][$b]."'><p>Hapus Jadwal</p></div>
				</li>
				";
			}			
			$c++;
		}
		?>
	</ul>
</div>
</div>
<a class="but-minggu" title="klik untuk menampilkan/menyembunyikan jadwal hari Minggu"><i class="fa fa-eye"></i> Show/Hide Minggu</a>

<script type="text/javascript">
	$('.hapusjadwal').click(function() {
		var id = $(this).attr('data-id');
		var sks = $(this).attr('data-sks');
		$.ajax({
			url: 'proses-kurang.php',
			type: 'get',
			data: {
				id: id,
				sks: sks
			},
			context: this,
			beforeSend: function() {
				$('#jadwal-footer .status4').fadeIn(200);
				$('img#makulloader').show();
				$('#overlaynya-overlay').fadeIn(200);
			},
			success: function() {
				$('ul#list-makul').load('makul.php', function() {
					$('img#makulloader').hide();
					$('#sisa-sks .counter').load('getsks.php');	
					$('#jadwal-footer .status4').hide(0);
					$('#jadwal-footer .status5').show(0).delay(1200).fadeOut(200);
				$('#overlaynya-overlay').fadeOut(200);
				});
				$('#jadwal-wrapper').load('jadwal.php');
			},
			error: function() {
				alert('error');
			}
		});
	});

	$('a.but-minggu').click(function() {
		$('#minggu-overlay').toggle('fade', 'fast');
	});
</script>
<?php
ob_end_flush();
?>