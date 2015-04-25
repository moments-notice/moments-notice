<?php

	include("include/init.php");

	login_ensure_loggedin();

	loadlib("admin");
	admin_ensure_authorized_role();

	loadlib("invite_codes");

	if ($page = get_int32("page")){
	   $more['page'] = $page;
	}

	$codes = invite_codes_get_all($more);

	$smarty->assign('codes', $codes);
	$smarty->assign("pagination", $codes['pagination']);
	$smarty->display('page_admin_invite_codes.txt');

	exit();
