<?php

	include("include/init.php");

	loadlib("rolls");

	$id = get_int64("id");

	$roll = rolls_get_inflated_roll_by_id($id);

	$smarty->assign('roll', $roll);
	$smarty->display('page_roll.txt');
	exit();
