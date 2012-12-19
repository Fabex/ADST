<?php

function debug () {
	echo '<pre>';
	$numargs = func_num_args();
	$arg_list = func_get_args();
	for ($i = 0; $i < $numargs; $i++) {
		var_dump($arg_list[$i]);
	}
	echo '</pre>';
}


$betaSerie = new BetaSerie();
$betaSerie->memberAuthentication('login', 'mot_de_passe');
