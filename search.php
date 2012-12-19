<?php
require_once 'lib/BetaSerie.class.php';
require_once 'lib/Tools.lib.php';

$series = $betaSerie->serieSearch($_GET['term']);

$return = array();
foreach ($series as $key => $serie) {
	$return[] = array('id'=>$serie->url, 'label'=>$serie->title, 'value'=>$serie->title);
}

echo json_encode($return);



//[ { "id": "Aquila clanga", "label": "Greater Spotted Eagle", "value": "Greater Spotted Eagle" }, { "id": "Aquila pennata", "label": "Booted Eagle", "value": "Booted Eagle" }, { "id": "Aquila heliaca", "label": "Eastern Imperial Eagle", "value": "Eastern Imperial Eagle" }, { "id": "Bubo bubo", "label": "Eurasian Eagle Owl", "value": "Eurasian Eagle Owl" }, { "id": "Circaetus gallicus", "label": "Short-toed Eagle", "value": "Short-toed Eagle" }, { "id": "Aquila chrysaetos", "label": "Golden Eagle", "value": "Golden Eagle" }, { "id": "Aquila nipalensis", "label": "Steppe Eagle", "value": "Steppe Eagle" }, { "id": "Haliaeetus albicilla", "label": "White-tailed Eagle", "value": "White-tailed Eagle" }, { "id": "Aquila pomarina", "label": "Lesser Spotted Eagle", "value": "Lesser Spotted Eagle" }, { "id": "Aquila adalberti", "label": "Spanish Imperial Eagle", "value": "Spanish Imperial Eagle" }, { "id": "Aquila fasciata", "label": "Bonelli`s Eagle", "value": "Bonelli`s Eagle" }, { "id": "Haliaeetus leucoryphus", "label": "Pallas’s Fish Eagle", "value": "Pallas’s Fish Eagle" } ]
?>