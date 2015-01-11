<?php

	include("include/init.php");

	loadlib("rolls");

	$rolls = rolls_get_all();
	
	foreach( $rolls['rows'] as $roll){
		$rsp = rolls_get_inflated_roll_by_id($roll['id']);
		dumper($rsp);
	}

	$smarty->assign('rolls', $rolls['rows']);
	$smarty->display('page_rolls.txt');

	exit();
