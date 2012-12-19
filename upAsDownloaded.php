<?php
	require_once 'lib/BetaSerie.class.php';
	require_once 'lib/Tools.lib.php';
	
	$serie = $_POST['serie'];
	$season = $_POST['season']; 
	$episode = $_POST['episode'];
	
	$betaSerie->episodeDownloaded($serie, $season, $episode);
	
?>