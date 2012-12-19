<?php
require_once 'lib/BetaSerie.class.php';
require_once 'lib/Tools.lib.php';

$serie = $betaSerie->memberSeries('fabex');

?>

<!DOCTYPE html">
<html>
<head>
	<title>Automatic Download Series Torrent - <?php echo $serieDisplay->show->title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="icon" type="image/jpg" href="logo.jpg" />
	<link rel="stylesheet" href="css/bootstrapTwitter.css">
	<link rel="stylesheet" href="css/jqueryUI.css">
	<link rel="stylesheet" href="css/main.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jqueryUI.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container">
	          	<a href="/" class="brand">Automatic Download Series Torrent</a>
	    	</div>
		</div>
	</div>
	
	<h1> Liste de mes Séries</h1>
	
	<div class="content">
		<div class="span12">
			<ul>
			<?php foreach ($serie->root->member->shows as $show) : ?>
				<li>
					<a href="listSeason.php?serie=<?php echo urlencode($show->url) ?>">
					<?php echo $show->title ?>
					</a>
				</li>
			<?php endforeach;?>
			</ul>
		</div>
	</div>
	
</body>
</html>
