<?php
	require_once 'lib/Addic7ed.class.php';
	$serie = $_REQUEST['serie'];
	$season = $_REQUEST['season'];
	$number = $_REQUEST['number'];
	$addic7edSrt = Addic7ed::getSrt($serie, $season, $number);
	echo $addic7edSrt;
?>