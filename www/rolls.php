<?php

	include("include/init.php");

	loadlib("rolls");

	$all_rolls = rolls_get_all();
	
	$rolls = array();

	$rolls['pagination'] = $all_rolls['pagination'];

	foreach( $all_rolls['rows'] as $roll){
		$rolls['rows'][] = rolls_get_inflated_roll_by_id($roll['id']);
	}

	$smarty->assign('rolls', $rolls);
	$smarty->display('page_rolls.txt');

	exit();
