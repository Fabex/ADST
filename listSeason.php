<?php
require_once 'lib/BetaSerie.class.php';
require_once 'config.php';

$betaSerie = new BetaSerie();
$betaSerie->memberAuthentication(LOGIN, MDP);

if (!empty($_GET['serie'])) {
	$serie = $_GET['serie'];
} else {
	echo 'No serie selectioned'; 
	die();
}

$serieDisplay = $betaSerie->serieDisplay($serie);
//debug($serieDisplay->show->title);

$seasons = $betaSerie->serieEpisode($serie);
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
	
	<h1> Liste des episodes de : <?php echo $serieDisplay->show->title; ?></h1>
	
	<ul class="nav nav-tabs" id="myTab">
		<?php $flag = false ?>
		<?php foreach ($seasons as $season) : ?>
		<?php $seasonNumber = $season->number < 10 ? '0'.$season->number : $season->number ?>
			<li <?php echo !$flag ? 'class="active"' : '' ?>><a href="#saison<?php echo $seasonNumber ?>">Saison <?php echo $seasonNumber ?></a></li>
			<?php $flag = true ?>
		<?php endforeach; ?>
	</ul>
		 
	<div class="tab-content">
		<?php $flag = false ?>
		<?php foreach ($seasons as $season) : ?>
			<?php $seasonNumber = $season->number < 10 ? '0'.$season->number : $season->number ?>
			<div class="tab-pane <?php echo !$flag ? 'active' : '' ?>" id="saison<?php echo $seasonNumber?>">
				<table class="table table-striped">
					<tr>
						<th>Episode</th>
						<th>Titre</th>
						<th>Action</th>
					</tr>
					<?php foreach ($season->episodes as $episode) :?>
					<tr>
						<td><?php echo $episode->number;?></td>
						<td><?php echo $episode->title;?></td>
						<td class="action">
							<a id="<?php echo $episode->show.'$$'.$season->number.'$$'.$episode->number?>"></a>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>				
			</div>
			<?php $flag = true ?>
		<?php endforeach; ?>
	</div>
	
	<script>
    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
        });
	</script>
</body>
</html>
