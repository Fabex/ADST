<?php

require_once 'lib/ThePirateBay.class.php';
$episode = $_GET['term'];
$tpbUrl = ThePirateBay::searchTorrent($episode);


$return = array();
if (!empty($tpbUrl)) {
	$return[] = array('id'=>0, 'label'=>$episode, 'value'=>$episode, 'data' => $tpbUrl);
} else {
	$return[] = array('id'=>0, 'label'=>'Pas de torrent trouvé', 'value'=>$episode);
}
echo json_encode($return);

?>