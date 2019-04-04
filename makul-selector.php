<?php
include "nyambung.php";
$query = mysql_query("SELECT * FROM makul ORDER BY makul") or die (mysql_error());
$c=1;
while ($data = mysql_fetch_array($query)) {
	$set[$c] = $data[0];
	if(isset($_COOKIE[$set[$c]])){
		echo "
		<li><input type='checkbox' name='".$data['id_makul']."' value='".$data['id_makul']."'>".$data['makul']." [".$data['sks']."]</li>
		";
	} else {
		echo "
		<li><input type='checkbox' name='".$data['id_makul']."' value='".$data['id_makul']."' checked>".$data['makul']." [".$data['sks']."]</li>
		";
	}
	$c++;
}
?>
<script type="text/javascript">
$(function(){
	var cek = [];
	$('#but-savesort').click(function() {
		$('form#form-sort').submit();
	});
	$('#select-makul li').click(function() {
		$(this).find('input[type="checkbox"]').click();
	});
	$('#select-makul li input:checkbox').click(function () {
		$(this).click();
	});
	$('a#select-all').click(function() {
		$('#select-makul li input:checkbox').prop('checked', true);
	});
	$('a#select-none').click(function() {
		$('#select-makul li input:checkbox').prop('checked', false);
	});
});
</script>