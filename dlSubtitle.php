<?php

$serie = $_POST['serie'];
$season = $_POST['season'];
$episode = $_POST['episode'];
$file = $_POST['link'];

$newfile = 'tmp/tmp_file';

if (!copy($file, $newfile)) {
	echo "failed to copy $file...\n";
}

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$myme = finfo_file($finfo, $newfile);

if (strpos($myme, 'text') !== false) {
	$content = file_get_contents($newfile);
} else {
	$zip = zip_open($newfile);
	$content = '';
	while($ze = zip_read($zip)) {
		while($t = zip_entry_read($ze)) {
			$content .= $t;
		}
		break;
	}
}


$dir = 'Series/'.$serie.'/'.$serie.' S0'.$season;
if ($d = opendir($dir)) {
	while($filename = readdir($d)) {
		if (strpos($filename, $episode)) {
			$filenameVideo = $filename;
			break;
		}
	}
}
closedir($d);
$ext = pathinfo($dir.'/'.$filenameVideo, PATHINFO_EXTENSION);
$filenameSub = str_replace($ext, 'srt', $filenameVideo);
touch($filenameSub);
file_put_contents($dir.'/'.$filenameSub, $content);

?>