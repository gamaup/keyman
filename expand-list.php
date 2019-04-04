<?php
ob_start();
include "nyambung.php";
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

	$nim = $_COOKIE['nim'];
	$query_next = mysql_query("SELECT ke FROM simpan WHERE nim = $nim ORDER BY ke DESC");
	if (mysql_num_rows($query_next) != 0) {
		$hasil_next = mysql_result($query_next, 0);
		$next = $hasil_next+1;
	} else {
		$next = 1;
	}

?>
<div id='expand-list'>
	<div id="expand-list-atas">
		<h3><?php echo $_COOKIE['nim'].'-'.$next; ?></h3>
		<img src="gambar/powered.png" style="float:right" title="Powered by KEYMAN"/>
	</div>
	<div id="ex-list-header">
		<div class='ex-list-makul'>
			Mata Kuliah
		</div>
		<div class="ex-list-dosen">
			Dosen
		</div>
		<div class='ex-list-sks'>
			SKS
		</div>
		<div class='ex-list-hari'>
			Hari
		</div>
		<div class='ex-list-jam'>
			Jam
		</div>
		<div class='ex-list-kelas' style='text-transform:capitalize;'>
			Kelas
		</div>
	</div>
	<ul id='ul-expand-list'>
		<?php
		$a = 1;
		$queryall = mysql_query("SELECT id_jadwal FROM jadwal ORDER BY id_jadwal") or die (mysql_error());
		while ($data = mysql_fetch_array($queryall)){
			if (isset($_COOKIE['id'.$data['id_jadwal']])) {
				$id[$a] = $data['id_jadwal'];
				$querymakul[$a] = mysql_query("SELECT j.id_jadwal, m.id_makul, m.makul, j.dosen, j.hari, j.jam_mulai, j.jam_selesai, m.sks, j.kelas
					FROM makul m
					INNER JOIN jadwal j
					    on m.id_makul = j.id_makul
					WHERE j.id_jadwal = $id[$a]") or die (mysql_error());
				$makul[$a] = mysql_fetch_row($querymakul[$a]);
				echo "
					<li>
						<div class='ex-list-makul'>
							".$makul[$a][2]."
						</div>
						<div class='ex-list-dosen'>
							".$makul[$a][3]."
						</div>
						<div class='ex-list-sks'>
							".$makul[$a][7]."
						</div>
						<div class='ex-list-hari'>
							".$makul[$a][4]."
						</div>
						<div class='ex-list-jam'>
							".floattojam($makul[$a][5])."-".floattojam($makul[$a][6])."
						</div>
						<div class='ex-list-kelas'>
							".$makul[$a][8]."
						</div>
					</li>
				";
			}
			$a++;
		}
		?>
	</ul>
</div>
<div id="expand-list-menu">
	<div class='expand-list-menu list-menu-simpan'>
		<p><em>* Drag list jadwal untuk mengurutkan</em></p>
		<a id="list-simpan" class="button"><i class='fa fa-floppy-o'></i> Save</a>
		<a id='list-saving' class='button'>Menyimpan...</a>
	</div>
	<div class='expand-list-menu list-menu-saved'>
		<a target='_blank' id='saved-share' class='button'><i class='fa fa-users'></i> Share</a>
		<a id='saved-view' class='button' target='_blank'><i class='fa fa-share-square-o'></i> View</a>
		<a id='saved-download' class='button'><i class='fa fa-download'></i> Download</a>
	</div>
</div>

<script>
	$('a#list-simpan3').click(function() {
		$('p#judul-jadwal-tooltip').stop(0).css('display','inline').fadeIn(0).delay(2000).fadeOut(400);
	});
	$('input#judul-jadwal').hover(function() {
		$('p#judul-jadwal-tooltip').stop(0).css('display','inline').fadeIn(0);
	}, function() {
		$('p#judul-jadwal-tooltip').stop(0).css('display','inline').fadeOut(0);
	})
	$('#ul-expand-list li').mousedown(function() {
		$(this).css('cursor', 'move');
	});
	$('#ul-expand-list li').mouseup(function() {
		$(this).css('cursor', 'pointer');
	});
	$('#ul-expand-list').sortable();
	$('a#list-simpan').click(function() {
		html2canvas($("#expand-list"), {
	        onrendered: function(canvas) {
	            // canvas is the final rendered <canvas> element
	            var myImage = canvas.toDataURL("image/png");
	            $.ajax({
	            	url: 'proses-simpan.php',
	            	type: 'post',
	            	data: {file: myImage},
	            	beforeSend: function() {
						$('a#list-simpan').hide();
						$('a#list-saving').show();
						$('#overlaynya-overlay').fadeIn(200);
					},
	            	success: function(data) {
	            		$('.list-menu-simpan').addClass('list-menu-simpan-saved');
	            		$('a#saved-share').attr('href','https://www.facebook.com/sharer/sharer.php?u=http://www.inncomedia.com/keyman/jadwal/'+data);
	            		$('a#saved-view').attr('href','jadwal/'+data);
	            		$('a#saved-download').attr('href','proses-simpan2.php?img=jadwal/'+data);
						$('#overlaynya-overlay').fadeOut(200);
	            	},
	            	error: function() {
	            		alert('error');
	            	}
	            });
	            //window.open(myImage);
	        }
	    });
	})
</script>
<?php
ob_end_flush();
?>