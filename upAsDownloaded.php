<?php
	require_once 'lib/BetaSerie.class.php';
	require_once 'config.php';
	
	$betaSerie = new BetaSerie();
	$betaSerie->memberAuthentication(LOGIN, MDP);

	$serie = $_POST['serie'];
	$season = $_POST['season']; 
	$episode = $_POST['episode'];
	
	$betaSerie->episodeDownloaded($serie, $season, $episode);
	
?>
