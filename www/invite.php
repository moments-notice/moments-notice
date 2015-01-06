<?php
	include("include/init.php");

	login_ensure_loggedout();

	loadlib("invite_codes");

	if (! $GLOBALS['cfg']['enable_feature_invite_codes']){
		error_404();
	}

	$code = get_str("code");

	if (! $code){
		# seriously, go away...
		header("location: /");
		exit();
	}

	# if the code is invalid

	$invite = invite_codes_get_by_code($code, 0, 1);

	if (! $invite){
		error_403();
	}

	$smarty->assign('code', $code);

	if (post_isset('done')){

		# grab and validate form

		# save form data

		# delete the invite code / mark it used
		$now = time();
		$update = array(
			"redeemed" => $now
		);

		invite_codes_update($invite, $update);
		
		# send user to a thank you page
		$smarty->display("page_invite_thank_you.txt");
		exit();

	}

	$smarty->display("page_invite.txt");
	exit();
	
