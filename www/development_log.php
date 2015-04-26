<?php

	include("include/init.php");

	loadlib("development_log");

	if ($page = get_int32("page")){
	   $more['page'] = $page;
	}

	$logs = development_log_get_all($more);

	$smarty->assign('logs', $logs);
	$smarty->assign("pagination", $logs['pagination']);
	$smarty->display('page_development_log.txt');

	exit();
