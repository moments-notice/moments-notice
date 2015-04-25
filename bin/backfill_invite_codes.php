<?php

	include("init_local.php");

	loadlib("invite_codes");
	
	### get all the invite codes that were redeemed
	
	$codes = invite_codes_get_all_redeemed();
	
	### update their user_id in InviteCodes

	foreach ($codes['rows'] as $code){
		$user = users_get_by_email($code['email']);
		
		$update = array(
			"user_id" => $user['id'],
		);

		$rsp = invite_codes_update($code, $update);
		dumper($rsp);
	}
	exit();