<?php

	include("include/init.php");

	loadlib("rolls");
	loadlib("photos");

	$id = get_int64("id");

	$roll = rolls_get_inflated_roll_by_id($id);

	if (! $roll){
	   error_404();
	}
	
	if ($page = get_int32("page")){
	   $more['page'] = $page;
	}
	
	$more['per_page'] = 1;

	$photos = photos_get_photos_by_roll($id, $more);

	$smarty->assign('photos', $photos['rows']);

	$smarty->assign("pagination", $photos['pagination']);
	$smarty->assign('roll', $roll);
	$smarty->display('page_roll.txt');
	exit();
