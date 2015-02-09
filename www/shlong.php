<?php

	include("include/init.php");
	loadlib("shlong");

	$short_url = get_str("short_url");

	if (! $short_url){
		error_404();
	}

	$long_url = shlong_get_long_URL($short_url);

	if (! $long_url){
		error_404();
	}

	if ($short_url == $long_url){
		error_500();
	}

	shlong_redirect($long_url['long_url'], $short_url);
	exit();
  
?>
