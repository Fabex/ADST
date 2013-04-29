<?php

use Symfony\Component\Yaml\Yaml;

function debug () {
	echo '<pre>';
	$numargs = func_num_args();
	$arg_list = func_get_args();
	for ($i = 0; $i < $numargs; $i++) {
		var_dump($arg_list[$i]);
	}
	echo '</pre>';
}

$yaml = Yaml::parse(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'parameters.yml');

$betaSerie = new BetaSerie();
$betaSerie->memberAuthentication($yaml['beta_series']['login'], $yaml['beta_series']['password']);
