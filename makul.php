<?php
ob_start();
include('nyambung.php');

$cursks = $_COOKIE['sks'];

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

if(isset($_COOKIE['sort'])) {
	$sort = unserialize($_COOKIE['sort']);
} else {
	$querysort= mysql_query("SELECT id_makul FROM makul ORDER BY id_makul");
	$s=1;
	while($datasort = mysql_fetch_row($querysort)){
		$id[$s] = $datasort[0];
		$sort[$id[$s]] = "";
		$s++;
	}
}

$querymakul0 = mysql_query("SELECT * FROM makul WHERE makul LIKE '%' ORDER BY makul");
$restrict = "";
while ($data0 = mysql_fetch_row($querymakul0)){
	if($sort[$data0[0]] == "ora"){
		$restrict = $restrict."AND id_makul <> ".$data0[0]." ";
	}
}

$a = 1;
$b = 1;
$querymakul = mysql_query("SELECT * FROM makul WHERE makul LIKE '%' ".$restrict." ORDER BY makul");
if (mysql_num_rows($querymakul)>0){
	while($datamakul = mysql_fetch_row($querymakul)){
		$id_makul[$a] = $datamakul[0];
		$makul[$a] = $datamakul[1];
		$sks[$a] = $datamakul[2];
		$queryjadwal[$a] = mysql_query("SELECT j.id_jadwal, m.id_makul, m.makul, j.dosen, j.hari, j.jam_mulai, j.jam_selesai, m.sks
			FROM makul m
			INNER JOIN jadwal j
			    on m.id_makul = j.id_makul
			WHERE m.id_makul = $id_makul[$a]
			ORDER BY j.dosen");
		$udah[$a] = "ora";
		$querycookie0[$a] = mysql_query("SELECT id_jadwal FROM jadwal ORDER BY id_jadwal");
		while ($datacookie0[$a] = mysql_fetch_array($querycookie0[$a])){
			$idcookie0[$a] = 'id'.$datacookie0[$a]['id_jadwal'];
			if(isset($_COOKIE[$idcookie0[$a]])) {
				$id_cookie0[$a] = $_COOKIE[$idcookie0[$a]];
				$querycookieinside0[$a] = mysql_query("SELECT id_jadwal, id_makul FROM jadwal WHERE id_jadwal = $id_cookie0[$a]");
				$data_qci0[$a] = mysql_fetch_array($querycookieinside0[$a]);
				if($id_makul[$a] == $data_qci0[$a]['id_makul']) {
					$udah[$a] = "iyo";
					break;
				}
			}
		}
		if ($udah[$a] == "iyo") {
			echo "<li class='makulpas' title='mata kuliah sudah diambil'><a>".$makul[$a]."</a><ul></ul></li>";
		} else if ($sks[$a] > $cursks) {
			echo "<li class='makulkurang' title='sisa sks tidak mencukupi'><div class='makul-sks' title='SKS'>".$sks[$a]."</div><a>".$makul[$a]."</a><ul></ul></li>";
		} else if ($udah[$a] == "ora") {
			echo "<li class='makul'><div class='makul-sks' title='SKS'>".$sks[$a]."</div><a>".$makul[$a]."</a><ul>";
			while($datajadwal[$a] = mysql_fetch_row($queryjadwal[$a])){
				$id_jadwal[$a][$b] = $datajadwal[$a][0];
				$id_makul[$a][$b] = $datajadwal[$a][1];
				$makul[$a][$b] = $datajadwal[$a][2];
				$dosen[$a][$b] = $datajadwal[$a][3];
				$hari[$a][$b] = $datajadwal[$a][4];
				$jammulai1[$a][$b] = $datajadwal[$a][5];
				$jamselesai1[$a][$b] = $datajadwal[$a][6];
				$jam_mulai[$a][$b] = floattojam($jammulai1[$a][$b]);
				$jam_selesai[$a][$b] = floattojam($jamselesai1[$a][$b]);
				$sks[$a][$b] = $datajadwal[$a][7];
				if(isset($_COOKIE[$id_jadwal[$a][$b]])){
					$id_jadwalcookie[$a][$b] = $_COOKIE[$id_jadwal[$a][$b]];
				} else {
					$id_jadwalcookie[$a][$b] = 0;
				}
				$tabrakan[$a][$b] = "ora";
				$querycookie = mysql_query("SELECT id_jadwal FROM jadwal ORDER BY id_jadwal");
				$c = 1;
				while ($datacookie = mysql_fetch_array($querycookie)){
					$idcookie[$c] = $datacookie['id_jadwal'];
					if(isset($_COOKIE['id'.$idcookie[$c]])) {
						$id_cookie[$c] = $_COOKIE['id'.$idcookie[$c]];
						$querycookieinside[$c] = mysql_query("SELECT id_jadwal, hari, jam_mulai, jam_selesai FROM jadwal WHERE id_jadwal = $id_cookie[$c]");
						$data_qci[$c] = mysql_fetch_array($querycookieinside[$c]);
						$hariinside[$c] = $data_qci[$c]['hari'];
						$jammulaiinside[$c] = $data_qci[$c]['jam_mulai'];
						$jamselesaiinside[$c] = $data_qci[$c]['jam_selesai'];
						if(($hari[$a][$b]==$hariinside[$c])&&(((($jammulai1[$a][$b]>$jammulaiinside[$c])&&($jammulai1[$a][$b]<$jamselesaiinside[$c]))||(($jamselesai1[$a][$b]<=$jamselesaiinside[$c])&&($jamselesai1[$a][$b]>$jammulaiinside[$c])))||((($jammulai1[$a][$b]<=$jammulaiinside[$c])&&($jamselesai1[$a][$b]>$jammulaiinside[$c]))||(($jammulai1[$a][$b]<$jamselesaiinside[$c])&&($jamselesai1[$a][$b]>=$jamselesaiinside[$c]))))) {
							$tabrakan[$a][$b] = "iyo";
							break;
						}
					}
					$c++;
				}
				if ($tabrakan[$a][$b] == "iyo") {
					echo "<li class='passive' title='jadwal bertabrakan dengan jadwal yang sudah diambil'><h4>".$dosen[$a][$b]."</h4><h5>".$hari[$a][$b].", ".$jam_mulai[$a][$b]." - ".$jam_selesai[$a][$b]."</h5></li>";	
				} else {
					echo "<li class='active' data-sks='".$sks[$a][$b]."' data-id='".$id_jadwal[$a][$b]."'><h4>".$dosen[$a][$b]."</h4><h5>".$hari[$a][$b].", ".$jam_mulai[$a][$b]." - ".$jam_selesai[$a][$b]."</h5></li>";
				}
				$b++;
			}
			echo "</ul></li>";
		}
		$a++;
	}
} else {
	echo "<p style='color:#505050;font-size:10pt;text-align:center;margin:10px;display:block;'>tidak ada mata kuliah yang ditampilkan. silahkan klik menu sort list untuk menampilkan mata kuliah yang kamu inginkan.</p>";
}
?>
<script>
	$('ul#list-makul li.makul a').click(function(){
		$(this).parent().toggleClass('makul-clicked');
		$(this).parent().find('ul').toggle('blind', 'fast');
		$('ul#list-makul > li.makul a').not(this).parent().removeClass('makul-clicked');
		$('ul#list-makul > li.makul a').not(this).parent().find('ul').hide();
	});

	$('ul#list-makul li.makul ul li.active').click(function() {
		var id = $(this).attr('data-id');
		var sks = $(this).attr('data-sks');
		$.ajax({
			url: 'proses-tambah.php',
			type: 'get',
			data: {
				id: id,
				sks: sks
			},
			context: this,
			beforeSend: function() {
				$('#jadwal-footer .status2').fadeIn(200);
				$('img#makulloader').show();
				$('#overlaynya-overlay').fadeIn(200);
			},
			success: function() {
				$('ul#list-makul').load('makul.php', function() {
					$('img#makulloader').hide();
					$('#sisa-sks .counter').load('getsks.php');
					$('#jadwal-footer .status2').hide(0);
					$('#jadwal-footer .status3').show(0).delay(1200).fadeOut(200);
				$('#overlaynya-overlay').fadeOut(200);
				});
				$('#jadwal-wrapper').load('jadwal.php');
			},
			error: function() {
				alert('error');
			}
		});
	});
	$('ul#list-makul li ul li.passive, ul#list-makul li.makulpas, ul#list-makul li.makulkurang').tooltip({
        track: true,
        hide: {
        	effect: 'fade',
        	duration: 0
        }
    });
</script>
<?php
ob_end_flush();
?>