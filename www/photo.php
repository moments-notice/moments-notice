<?php

	include("include/init.php");

	loadlib("photos");

	$id = get_int64("id");

	$photo = photos_get_photo_by_id($id);

	if (! $photo){
	   error_404();
	}

	$smarty->assign('photo', $photo);
	$smarty->display('page_photo.txt');
	exit();
