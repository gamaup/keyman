$(document).ready(function() {
	$('#main-logo').hover(function() {
		$(this).find('.idle').hide();
		$(this).find('.hover').show();
	}, function() {
		$(this).find('.idle').show();
		$(this).find('.hover').hide();
	});

	$('#landing-main').hover(function() {
		$(this).find('.idle').hide();
		$(this).find('.hover').show();
	}, function() {
		$(this).find('.idle').show();
		$(this).find('.hover').hide();
	});

	$('.sks-box input.nim').keyup(function() {
		var isi = $(this).val();
		if (isi.length == 0 || isi > 0) {
			if (isi.length > 8) {
				$('#nim-notifikasi').show();
			} else {
				if (isi.length >= 2 && isi.substr(0,2) > 13) {
					$('#nim-notifikasi').show();
				} else {
					if (isi.length >= 5 && isi.substr(2,3) != 523) {
						$('#nim-notifikasi2').show();
					} else {
						$('#nim-notifikasi').hide();
						$('#nim-notifikasi2').hide();
					}
				}
			}
		} else {
			$('#nim-notifikasi').show();
		}
	});

	$('.sks-box input.sks').keyup(function() {
		var isi = $(this).val();
		if(isi <= 24 && isi >0){
			$('#sks-notifikasi').hide();
			$('#sks-notifikasi2').hide();
		} else {
			$('#sks-notifikasi').show();
			$('#sks-notifikasi2').hide();
		}
	});

	$('#but-sks').click(function() {
		var isinim = $('.sks-box input.nim').val();
		var isisks = $('.sks-box input.sks').val();
		if (isinim.length == 0 || isinim > 0) {
			if (isinim.length != 8) {
				$('#nim-notifikasi').show();
			} else {
				if (isinim.length >= 2 && isinim.substr(0,2) > 13) {
					$('#nim-notifikasi').show();
				} else {
					if (isinim.length >= 5 && isinim.substr(2,3) != 523) {
						$('#nim-notifikasi2').show();
					} else if(isisks > 24 || isisks.length == 0){
						$('#sks-notifikasi').show();
					} else {
						$('#nim-notifikasi').hide();
						$('#nim-notifikasi2').hide();
						$('#sks-notifikasi').hide();
						$.ajax({
							url: 'setsks.php',
							type: 'post',
							data: {
								sks: isisks,
								nim: isinim
							},
							context: this,
							success: function() {
								location.href = "index.php";
							},
							error: function() {
								alert('error');
							}
						});
					}
				}
			}
		} else {
			$('#nim-notifikasi').show();
		}
	});

	$('.sks-box input.sks, .sks-box input.nim').keypress(function(e) {
	    if(e.which == 13) {
	        var isinim = $('.sks-box input.nim').val();
			var isisks = $('.sks-box input.sks').val();
			if (isinim.length == 0 || isinim > 0) {
				if (isinim.length > 8) {
					$('#nim-notifikasi').show();
				} else {
					if (isinim.length >= 2 && isinim.substr(0,2) > 13) {
						$('#nim-notifikasi').show();
					} else {
						if (isinim.length >= 5 && isinim.substr(2,3) != 523) {
							$('#nim-notifikasi2').show();
						} else if(isisks > 24 || isisks.length == 0){
							$('#sks-notifikasi').show();
						} else {
							$('#nim-notifikasi').hide();
							$('#nim-notifikasi2').hide();
							$('#sks-notifikasi').hide();
							$.ajax({
								url: 'setsks.php',
								type: 'post',
								data: {
									sks: isisks,
									nim: isinim
								},
								context: this,
								success: function() {
									location.href = "index.php";
								},
								error: function() {
									alert('error');
								}
							});
						}
					}
				}
			} else {
				$('#nim-notifikasi').show();
			}
	    }
	});

	$("#list-makul").slimScroll({
		height: '415px',
		wheelStep: 7,
		railVisible: true,
    	alwaysVisible: true,
    	color: '#475577',
    	railColor: '#e9e9e7',
    	railOpacity: 0
	});

	$("#select-makul").slimScroll({
		height: '455px',
		wheelStep: 10
	});

	$("#open-list").slimScroll({
		height: '268px',
		wheelStep: 10
	});

	$('#makul .cari input').focus(function() {
		$(this).css({color:"#fff"});
	});
	$('#makul .cari input').blur(function() {
		$(this).css({color:"#757575"});
	});

	$('ul#list-makul').load('makul.php', function() {
		$('img#makulloader').hide();
		$('#sisa-sks .counter').load('getsks.php');
	});
	$('#jadwal-wrapper').load('jadwal.php');
	$('#select-makul').load('makul-selector.php');

	$('#tgrid').click(function() {
		$('img#expand-loader').show();
		$('#expand-wrapper').load('expand-grid.php',function() {
			$('img#expand-loader').hide();
		});
		$(this).find('img.idle').hide();
		$(this).find('img.aktif').show();
		$('.expand-toggle').not(this).find('img.aktif').hide();
		$('.expand-toggle').not(this).find('img.idle').show();
	});

	$('#tlist').click(function() {
		$('img#expand-loader').show();
		$('#expand-wrapper').load('expand-list.php',function() {
			$('img#expand-loader').hide();
		});
		$(this).find('img.idle').hide();
		$(this).find('img.aktif').show();
		$('.expand-toggle').not(this).find('img.aktif').hide();
		$('.expand-toggle').not(this).find('img.idle').show();
	});

	$('a#but-full').click(function() {
		$('#overlay2').fadeIn(200);
		$('#tlist').click();
	});

	$('a#expand-close').click(function() {
		$('#overlay2').fadeOut(200);
		$('#tlist').click();
	});

	$('#makul a#but-sort').click(function() {
		$('#overlay').fadeIn(200);
		$('#makul-selector').fadeIn(200);
	});

	$('#makul-selector i.close-selector').click(function() {
		$('#overlay').fadeOut(200);
		$('#makul-selector').fadeOut(200);
	});

	$('#header-how-to').click(function() {
		$('#overlay').fadeIn(200);
		$('#readme-wrapper').fadeIn(200);
	});

	$('i#howto-close').click(function() {
		$('#overlay').fadeOut(200);
		$('#readme-wrapper').fadeOut(200);
	});

	$('a#but-reset').click(function() {
		$('#overlay').fadeIn(200);
		$('#alert-reset').fadeIn(200);
	});
	$('a#reset-cancel, i#reset-cancel2').click(function() {
		$('#overlay').fadeOut(200);
		$('#alert-reset').fadeOut(200);
	});
	$('#header-open-window').click(function() {
		$('#overlay').fadeIn(200);
		$('#open-window').fadeIn(200);
	});
	$('i#open-close').click(function() {
		$('#overlay').fadeOut(200);
		$('#open-window').fadeOut(200);
	});
	$('#header-share').click(function() {
		$('#overlay').fadeIn(200);
		$('#share-window').fadeIn(200);
	});
	$('i#share-close').click(function() {
		$('#overlay').fadeOut(200);
		$('#share-window').fadeOut(200);
	});
});