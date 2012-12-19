<?php

$id = $_GET['id'];

$tmp = explode('$$', $id);

$serie = $tmp[0];
$season = $tmp[1];
$episode = $tmp[2];


$dir = 'Series/'.$serie.'/'.$serie.' S0'.$season;
if ($d = opendir($dir)) {
	while($filename = readdir($d)) {
		if (strpos($filename, $episode) && !strpos($filename, 'srt')) {
			$filenameVideo = $filename;
			break;
		}
	}
}
closedir($d);
echo 'dev/adst/'.$dir.'/'.$filenameVideo;

?>