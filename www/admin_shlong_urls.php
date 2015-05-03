<?php

	include("include/init.php");

	login_ensure_loggedin();

	loadlib("admin");
	admin_ensure_authorized_role();

	loadlib("shlong");

	if ($page = get_int32("page")){
	   $more['page'] = $page;
	}

	$urls = shlong_get_urls($more);

	$smarty->assign('urls', $urls);
	$smarty->assign("pagination", $urls['pagination']);
	$smarty->display('page_admin_shlong_urls.txt');

	exit();
