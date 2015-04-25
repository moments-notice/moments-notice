<?php

	include("include/init.php");

	login_ensure_loggedin();

	loadlib("admin");
	admin_ensure_authorized_role();

	if ($page = get_int32("page")){
	   $more['page'] = $page;
	}

	$users = users_get_all($more);

	$smarty->assign('users', $users);
	$smarty->assign("pagination", $users['pagination']);
	$smarty->display('page_admin_users.txt');

	exit();
