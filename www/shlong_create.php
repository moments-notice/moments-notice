<?php

	include("include/init.php");
	
	login_ensure_loggedin();

	loadlib("admin");
	admin_ensure_authorized_role();


	loadlib("shlong");

	if (post_isset("url")){

		$url = post_str("url");

		$rsp = shlong_add_url($url, $more);
		$GLOBALS['smarty']->assign_by_ref("short", $rsp);
	}

	$GLOBALS['smarty']->display("page_shlong_create.txt");
	exit();

?>
