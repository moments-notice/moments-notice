<?php

	include("include/init.php");

	login_ensure_loggedin();

	loadlib("admin");
	admin_ensure_authorized_role();


	$paths = glob("templates/email*");

	$emails = array_map(function($val) {return substr($val, strpos($val, "/") + 1);}, $paths);
	

	if (post_str('send')){

		$email	= post_str('email');

		$args = array(
			'to_email'	=> $GLOBALS['cfg']['user']['email'],
			'template'	=> $email,
		);

		email_send($args);
		$smarty->assign('email_sent', 1);		
	}


	$smarty->assign('emails', $emails);
	$smarty->display('page_admin_emails.txt');
	exit();