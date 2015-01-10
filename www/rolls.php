<?php

	include("include/init.php");

	loadlib("rolls");

	$rolls = rolls_get_all();

	$smarty->assign('rolls', $rolls['rows']);
	$smarty->display('page_rolls.txt');

	exit();