<?php

function searchFile($dir, $episode)
{
    if ($d = opendir($dir)) {
        while ($filename = readdir($d)) {
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (strpos($filename, $episode)) {
                if (is_dir($dir . '/' . $filename)) {
                    return searchFile($dir . '/' . $filename, $episode);
                }
                if (in_array($ext, array('mp4', 'avi', 'mkv'))) {
                    return array($dir, $filename);
                }
            }
        }
    }
    return false;
}

function rrmdir($dir) {
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
            }
        }
        reset($objects);
        rmdir($dir);
    }
}

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
    while ($ze = zip_read($zip)) {
        while ($t = zip_entry_read($ze)) {
            $content .= $t;
        }
        break;
    }
}

$dir = 'Series/' . $serie . '/' . $serie . ' S0' . $season;
list($dir2, $filenameVideo) = searchFile($dir, $episode);

if ($dir2 != $dir) {
    rename($dir2 . '/' .$filenameVideo, $dir . '/' .$filenameVideo);
    rrmdir($dir2);
}

closedir($d);
$ext = pathinfo($dir . '/' . $filenameVideo, PATHINFO_EXTENSION);
$filenameSub = str_replace($ext, 'srt', $filenameVideo);
touch($dir . '/' . $filenameSub);
file_put_contents($dir . '/' . $filenameSub, $content);