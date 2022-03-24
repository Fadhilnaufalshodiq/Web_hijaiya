<?php
if ($_GET{"page"}){
	$page=$_GET{"page"}.".php";
	include "modul/$page";
	}
else {include"home.php";
	}
	?>
	