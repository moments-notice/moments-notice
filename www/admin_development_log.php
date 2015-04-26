<?php

	include("include/init.php");

	login_ensure_loggedin();

	loadlib("admin");
	admin_ensure_authorized_role();

	loadlib("development_log");

	if ($page = get_int32("page")){
	   $more['page'] = $page;
	}

	$logs = development_log_get_all($more);

	$smarty->assign('logs', $logs);
	$smarty->assign("pagination", $logs['pagination']);
	$smarty->display('page_admin_development_log.txt');

	exit();
