<?php
	require_once 'lib/ThePirateBay.class.php';
	$serie = $_REQUEST['serie'];
	$number = $_REQUEST['number'];
	$tpbUrl = ThePirateBay::getTorrent($serie, $number);
	echo $tpbUrl;
?>