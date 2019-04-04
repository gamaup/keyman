<?php
if (isset($_COOKIE['nim'])) {
	$nim = $_COOKIE['nim'];
} else {
	$nim = '';
}
?>

<div id="landing-back">
	<div id="landing-wrapper">
		<div id="landing-main">
			<div id="landing-logo">
				<img src="gambar/logo.png" class="idle"/>
				<img src="gambar/logo-hover.png" class="hover"/>
			</div>
		</div>
		<div id="set-sks">
			<div class='sks-box'>
				<h4>NIM</h4>
				<input type="text" class='nim' placeholder='contoh: 11523296' value=<?php echo "'".$nim."'"; ?>/>
				<div class='sks-notifikasi' id="nim-notifikasi">
					Format NIM Salah
				</div>
				<div class='sks-notifikasi' id="nim-notifikasi2">
					Hanya khusus Informatika
				</div>
			</div>
			<div class='sks-box'>
				<h4>Jumlah SKS yang diambil</h4>
				<input type="text" class='sks' placeholder='contoh: 24'/>
				<div class='sks-notifikasi' id="sks-notifikasi">
					Hanya Masukkan Angka 1-24
				</div>
				<div class='sks-notifikasi' id="sks-notifikasi2">
					Dibilangin ngeyel ya!
				</div>
			</div>
			<a id="but-sks">SET</a>
		</div>
	</div>
</div>
<center><p style='margin-top:10px; font-size: 14pt;'> &copy; 2014 | <a href="http://www.gamaup.net" target="_blank" style="color:#d9455f;">Gama Unggul Priambada</a></p></center>