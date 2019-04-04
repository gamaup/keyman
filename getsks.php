<?php
if ($_COOKIE['sks'] < 10) {
	echo "0".$_COOKIE['sks'];
} else {
	echo $_COOKIE['sks'];
}
?>