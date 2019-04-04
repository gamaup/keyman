<?php
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>KeyMan 1.2</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<link rel="stylesheet" type="text/css" href="lib/fa/css/font-awesome.min.css"/>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="Karena nyusun jadwal pake corat-coret kertas sudah terlalu greget">
	<meta property="og:title" content="KeyMan 1.2" />
	<meta property="og:type" content="article" />
	<meta property="og:image" content="http://www.inncomedia.com/keyman/gambar/Capture.PNG" /> 
	<meta property="og:description" content="Karena nyusun jadwal pake corat-coret kertas sudah terlalu greget" /> 
	<script src="lib/jquery-1.10.1.min.js"></script>
	<script src="lib/jquery-ui.js"></script>
	<script type="text/javascript" src="lib/jquery.cookie.js"></script>
	<script src="lib/slimscroll/jquery.slimscroll.js"></script>
	<script src="lib/html2canvas.js"></script>
	<script type="text/javascript" src="lib/script.js"/></script>
	<link rel="shortcut icon" type="image/x-icon" href="gambar/favicon.png">
</head>
<body>
	<div id="fb-root"></div>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=162276953853675";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	<?php
		if(isset($_COOKIE['sks'])) {
	?>
	<div id="overlay-wrapper">
		<div id='overlaynya-overlay'>
		</div>
		<div id="overlay">
		</div>
		<div id="overlay2">
			<div id="expand-header">
				<img src="gambar/logo-expand.png"/>
				<div id="expand-selector">
					<h4>View :</h4>
					<div id="tlist" class="expand-toggle" title="List">
						<img class="idle" src="gambar/icon-simple1.png">
						<img class="aktif" src="gambar/icon-simple2.png">
					</div>
					<div id="tgrid" class="expand-toggle" title="Grid">
						<img class="idle" src="gambar/icon-grid1.png">
						<img class="aktif" src="gambar/icon-grid2.png">
					</div>
					<img id="expand-loader" style="float:left;padding:10px;display:none;height:20px;width:20px;" src="gambar/ajax-expand-refresher.gif"/>
				</div>
				<a id="expand-close" class="button"><i class="fa fa-pencil-square-o"></i> Back to Editing Mode</a>
			</div>
			<div id="expand-wrapper">
				
			</div>
		</div>
		<div id="makul-selector">
			<h3>Pilih mata kuliah yang ingin ditampilkan</h3>
			<i class="fa fa-times-circle close-selector"></i>
			<form id="form-sort" method="post" action="proses-sort.php">
				<ul id="select-makul">
				</ul>
			</form>
			<div class="sort-menu">
				<a id="select-all" class="button2"><i class="fa fa-check-square-o"></i> Select All</a><a id="select-none" class="button2"><i class="fa fa-square-o"></i> Select None</a><a id="but-savesort" class="button"><i class='fa fa-floppy-o'></i> Simpan</a>
			</div>
		</div>
		<div id="readme-wrapper">
			<div style='width:550px; height: 30px; margin-bottom: 2px;'>
				<i id="howto-close" class="fa fa-times-circle"></i>
				<h3>How To</h3>
			</div>
			<?php include "readme.php" ?>
		</div>
		<div id="alert-reset">
			<div class="alert-header">
				RESET
				<i id="reset-cancel2" class="fa fa-times-circle"></i>
			</div>
			<div class="alert-konten">
				Melakukan RESET akan menghapus semua jadwal yang sudah dibuat. Pastikan kamu sudah menyimpan jadwal tersebut.
			</div>
			<div class="alert-button">
				<a style="float:right;width:80px;" href="reset.php" class="button">Lanjut</a><a id="reset-cancel" style="width:80px;float:right;margin-right:10px;" class="button2">Cancel</a>
			</div>
		</div>
		<div id='open-window'>
			<div style='width:250px; height: 30px; margin-bottom: 2px;'>
				<i id="open-close" class="fa fa-times-circle"></i>
				<h3>Saving History</h3>
			</div>
			<ul id='open-list'>
				<?php include 'saved-list.php'; ?>
			</ul>
		</div>
		<div id='share-window'>
			<div style='width:400px; height: 30px; margin-bottom: 2px;'>
				<i id="share-close" class="fa fa-times-circle"></i>
				<h3>About KeyMan</h3>
			</div>
			<img src='gambar/share-copyright.png'/>
			<p>Key-In Manager 1.2 &copy; 2014</p>
			<p>Developed by <a target='_blank' href='http://www.gamaup.net'>Gama Unggul Priambada</a></p>
			<p>Powered by <a target='_blank' href='http://www.inncomedia.com'>Inncomedia</a></p>
			<div id='socmed'>
				<div class="fb-like-box" data-href="http://www.facebook.com/inncomedia" data-colorscheme="light" data-show-faces="false" data-header="false" data-stream="false" data-show-border="false"></div>
				<a href="https://twitter.com/inncomedia" class="twitter-follow-button" data-show-count="false" data-lang="en" data-size="large">Follow @inncomedia</a>
			</div>
		</div>
	</div>
	<header>
		<div id="header-wrapper">
			<div id="logo">
				<div id="main-logo" class="logo">
					<img src="gambar/logo.png" class="idle"/>
					<img src="gambar/logo-hover.png" class="hover"/>
				</div>
			</div>
			<div id='header-kanan'>
				<div class="fb-like" data-href="http://www.inncomedia.com/keyman/index.php" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
				<div class='header-links'>
					<div class='show-nim'>
						Selamat datang, <?php echo $_COOKIE['nim']; ?>
					</div>
					<div id='header-open-window' class='header-link'>
						<i class="fa fa-folder-open"></i> Open
					</div>
					<div id='header-how-to' class='header-link'>
						<i class="fa fa-question-circle"></i> How To
					</div>
					<div id='header-share' class='header-link'>
						<i class="fa fa-thumbs-up"></i> About
					</div>
				</div>
			</div>
		</div>
	</header>
	<article>
		<div id="kiri">
			<div id="makul">
				<div class="head">
					Mata Kuliah
					<img id="makulloader" src="gambar/ajax-loader.gif" title="memuat daftar mata kuliah"/>
				</div>
				<ul id="list-makul">
				</ul>
				<div class="sort">
					<a id="but-sort" class="button"><i class="fa fa-list-ul"></i> Sort List</a>
				</div>
			</div>
			<div id="info">
				<b>Key-In Manager</b> by  <a style="color:#d9455f;" href="http://www.gamaup.net">Gama Unggul Priambada</a><br/>
				Powered by <a style="color:#d9455f;" href="http://www.inncomedia.com/">Inncomedia</a>
			</div>
		</div>
		<div id="kanan">
			<div id="sub-menu">
				<div id="sisa-sks">
					<div class="sks-sisa">Sisa SKS yang belum digunakan:</div>
					<div class="counter">
					</div>
				</div>
				<div id="jadwal-menu">
					<a id="but-full" class="button"/><i class="fa fa-floppy-o"></i> Saving Mode</a>
					<a id="but-reset" class="button"/><i class="fa fa-file-o"></i> Reset</a>
				</div>
			</div>
			<div id="jadwal-wrapper">
			</div>
			<div id="jadwal-footer">
				<div class="notifikator">
					<img style="margin:0 10px 0 0;float:left;" title="activity" src="gambar/icon-clock.png"/>idle
					<div class="status2">menambahkan mata kuliah ke jadwal</div>
					<div class="status3">mata kuliah berhasil ditambahkan ke jadwal</div>
					<div class="status4">menghapus mata kuliah dari jadwal</div>
					<div class="status5">mata kuliah berhasil dihapus dari jadwal</div>
				</div>
			</div>
		</div>
	</article>
	<?php
		} else {
			include "landing.php";
		}
	?>
</body>
</html>
<?php
if(isset($_COOKIE['sks']) && isset($_COOKIE['nim'])){
	echo "
	<script>
		$(function() {
			$('#sisa-sks').show();
			$('#makul').show();
			$('#sub-menu').show();
			$('#jadwal-wrapper').show();
		})
	</script>
	";
}
ob_end_flush();
?>