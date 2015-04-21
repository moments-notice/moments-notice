<?php

	include('include/init.php');

	login_ensure_loggedin();

	loadlib("admin");
	admin_ensure_authorized_role();

	$smarty->display('page_admin.txt');