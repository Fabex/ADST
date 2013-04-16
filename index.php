<?php
require_once('vendor/autoload.php');
require_once 'lib/BetaSerie.class.php';
require_once 'lib/Torrent.class.php';
require_once 'lib/Tools.lib.php';

if (isset($_GET['action'])) {
	switch ($_GET['action']) {
		case 'watched' :
			$betaSerie->episodeWatched($_GET['serie'], $_GET['season'], $_GET['episode']);
			break;
		case 'add' :
			$betaSerie->serieAdd($_GET['serie']);
			break;
	}
	header('Location: /');
}

if (isset($_GET['mode'])) {
	$mode = $_GET['mode'];
	if ($mode == 'last') {
		$betaSerie->memberLastEpisode();
	} else {
		$betaSerie->memberAllLastEpisode();
	}
} else {
	$betaSerie->memberLastEpisode();
}
$nbSerie = 0;
?>

<!DOCTYPE html">
<html>
<head>
	<title>Automatic Download Series Torrent</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="icon" type="image/jpg" href="logo.jpg" />
	<link rel="stylesheet" href="css/bootstrapTwitter.css">
	<link rel="stylesheet" href="css/jqueryUI.css">
	<link rel="stylesheet" href="css/main.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jqueryUI.js"></script>
</head>
<body>
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container">
	          	<a href="/" class="brand">Automatic Download Series Torrent</a>
	          	<form class="navbar-search pull-left" action="">
					<input type="text" id="suggestSerieBS" class="search-query span2 suggest" placeholder="Beta Series Search" />
					<input type="hidden" name="serie" id="serieBS" />
					<input type="hidden" name="action" value="add"/>
					<input type="submit" class="btn btn-primary nav-button" value="Add series" />
				</form>
	          	<form class="navbar-search pull-left" action="" style="margin-left: 15px;">
					<input type="text" id="suggestSerieTPB" class="search-query span2 suggest" placeholder="The Pirate Bay download" />
				</form>
	    	</div>
		</div>
	</div>
	<div style="margin-bottom:5px; text-align: center;">
		<a href="?mode=last" class="btn btn-success">Last episodes</a>
		<a href="?mode=all" class="btn btn-success">All episodes</a>
		<a href="/listSerie.php" class="btn">My series</a>
	</div>
	<table class="table table-striped">
		<tr>
			<th>Série</th>
			<th>Saison</th>
			<th>Episode</th>
			<th>Torrent</th>
			<th>Sous Titre</th>
			<th>Action</th>
		</tr>
<?php foreach ($betaSerie->getLastEpisode() as $episode) : ?>
<?php
	$nbSerie++;
	$serie = $episode->show;
	$number = $episode->number;
	$serieUrl = $episode->url;
	$season = $episode->season;
	$episodeNumber = $episode->episode;
	$watchedUrl = '?action=watched&serie='.$serieUrl.'&season='.$season.'&episode='.$episodeNumber;
	$torrentId = uniqid('utp_');
	$isDownloaded = $episode->downloaded;
?>
		<tr>
			<td class="serie">
				<a href="listSeason.php?serie=<?php echo urlencode($serieUrl) ?>">
				<?php echo $serie?>
				</a>
			</td>
			<td><?php echo $season?></td>
			<td><?php echo $episodeNumber?></td>
			<td>
				<?php if (!$isDownloaded) : ?>
				<a id="<?php echo $torrentId ?>"><?php echo $serie. ' '. $number; ?></a>
				<br />
				<a onclick="upAsDownloaded('<?php echo $serieUrl.'\',\''.$season.'\',\''.$episodeNumber?>')">downloaded</a>
				<script>
					$.ajax({
						url: "getTorrentUrl.php",
						type: "POST",
						data : {
							serie : '<?php echo $serie?>',
							number :  '<?php echo $number?>'
						},
						success: function(data){
							if (data != '') {
								$('#<?php echo $torrentId ?>').attr('href', data);
								$('#<?php echo $torrentId ?>').attr('style', 'color:green');
							} else {
								$('#<?php echo $torrentId ?>').attr('style', 'color:red');
							}
					  	}
					});
				</script>
				<?php else :?>
					<?php echo $serie. ' '. $number; ?>
					<br/>
					<a onclick="upAsDownloaded('<?php echo $serieUrl.'\',\''.$season.'\',\''.$episodeNumber?>')">undownloaded</a>
				<?php endif;?>
			</td>
			<td>
				<ul>
					<?php if (property_exists($episode, 'subs')):?>
						<?php foreach ($episode->subs as $sub) : ?>
							<?php if ($sub->language == 'VF') : ?>
								<li>
									<a href="#" onclick="dlSubtitle('<?php echo $sub->url?>', '<?php echo $serie.'\',\''.$season.'\',\''.$number?>')"><?php echo $sub->file?> </a>
									 - <a href="<?php echo $sub->url?>">Real Link</a>
								</li>
							<?php endif;?>
						<?php endforeach;?>
					<?php endif;?>
				</ul>
			</td>
			<td class="<?php echo $isDownloaded ? 'action' : '' ?>">
				<a id="<?php echo $serie.'$$'.$season.'$$'.$number?>" href="<?php echo $watchedUrl?>">Watched</a>
			</td>
		</tr>
<?php endforeach;?>
	</table>
<script type="text/javascript">
$(document).ready(function(){
	$( "#suggestSerieBS" ).autocomplete({
		source: "search.php",
		minLength: 2,
		select: function( event, ui ) {
			$('#serieBS').val(ui.item.id);
		}
	});
	$( "#suggestSerieTPB" ).autocomplete({
		source: "searchTPB.php",
		minLength: 2,
		select: function( event, ui ) {
			if (ui.item.data) {
				window.location = ui.item.data;
			}
		}
	});
});

function dlSubtitle(link, serie, season, episode) {
	$.ajax({
		url: "dlSubtitle.php",
		type: "POST",
		data : {
			'link' : link,
			'serie' : serie,
			'season' : season,
			'episode' : episode
		},
		success: function(data){

	  	}
	});
	return true;
}

function upAsDownloaded(serie, season, episode) {
	$.ajax({
		url: "upAsDownloaded.php",
		type: "POST",
		data : {
			'serie' : serie,
			'season' : season,
			'episode' : episode
		},
		success: function(data){

	  	}
	});
	return true;
}
</script>
<?php if (!$nbSerie) : ?>
Pas d'épisode pour l'instant
<?php endif;?>
</body>
</html>



