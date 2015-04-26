<?php

	include("include/init.php");

	loadlib("development_log");

	login_ensure_loggedin();

	loadlib("admin");
	admin_ensure_authorized_role();

	$crumb_key = 'development_log';
	$smarty->assign("crumb_key", $crumb_key);

	if (post_isset('create') && crumb_check($crumb_key)){
		
		## create a new log entry
		$developer = request_str("developer");
		$temp = request_str("temp");
		$time = request_str("time");
		$notes = request_str("notes");

		$log = array(
			"developer" => $developer,
			"development_time" => $time,
			"development_temp" => $temp,
			"development_notes" => $notes,
		);

		$rsp = development_log_create_log($log);

		if ($rsp['ok']){
			$url = "{$GLOBALS['cfg']['abs_root_url']}admin/darkroom/development";
			header("location: {$url}");
			exit();
		}
	}

	$smarty->display("page_admin_development_log_create.txt");
	exit();
