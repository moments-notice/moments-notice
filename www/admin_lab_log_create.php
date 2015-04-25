<?php

	include("include/init.php");

	loadlib("lab_log");

	login_ensure_loggedin();

	loadlib("admin");
	admin_ensure_authorized_role();

	$crumb_key = 'lab_log';
	$smarty->assign("crumb_key", $crumb_key);

	if (post_isset('create') && crumb_check($crumb_key)){
		
		## create a new log entry
		$chemname = request_str("chemname");
		$notes = request_str("notes");

		$log = array(
			"chem_name" => $chemname,
			"notes" => $notes,
		);

		$rsp = lab_log_create_log($log);

		if ($rsp['ok']){
			$url = "{$GLOBALS['cfg']['abs_root_url']}admin/darkroom/chemistry";
			header("location: {$url}");
			exit();
		}
	}

	$smarty->display("page_admin_lab_log_create.txt");
	exit();

