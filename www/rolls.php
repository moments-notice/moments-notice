<?php

	include("include/init.php");

	loadlib("rolls");

	if ($page = get_int32("page")){
	   $more['page'] = $page;
	}

	$all_rolls = rolls_get_all($more);
	
	$rolls = array();

	$rolls['pagination'] = $all_rolls['pagination'];

	foreach( $all_rolls['rows'] as $roll){
		 if ( $roll['film_type']){
		    $rolls['rows'][] = rolls_get_inflated_roll_by_id($roll['id']);
		 }
	}

	$smarty->assign('rolls', $rolls);
	$smarty->assign("pagination", $rolls['pagination']);
	$smarty->display('page_rolls.txt');

	exit();
