<?php

	include("include/init.php");

	loadlib("rolls");

	$id = get_int64("id");

	$roll = rolls_get_inflated_roll_by_id($id);

	if (! $roll){
	   error_404();
	}

	$smarty->assign('roll', $roll);
	$smarty->display('page_roll.txt');
	exit();
