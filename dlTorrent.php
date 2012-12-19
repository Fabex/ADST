<?php
	require_once 'lib/ThePirateBay.class.php';
	
	$id = $_REQUEST['id'];
	$tmp = explode(',', $id);

	$serie = $tmp[0];
	$season = $tmp[1];
	$number = $tmp[2];
	$tpbUrl = ThePirateBay::getTorrent($serie, $number);
	$dir = '/media/Serie/'.$serie.'/'.$serie.' S0'.$season;
	$dir = str_replace(' ', '\ ', $dir);
	echo json_encode(array('-O', $dir, $tpbUrl));
