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
		
		$ok = 1;

		# grab and validate form

		# check if they already have an account
		$user = users_get_by_email($invite['email']);

		if (! $user){
			
			loadlib("random");

			# create a user from their username field, email, and temp password
			$username = post_str('username');
			$fullname = post_str('fullname');
			$tmp_password = random_string(32);

			$smarty->assign('username', $username);
			
			#
			# all fields are in order?
			#

			if (!strlen($username)){

				$smarty->assign('error_missing', 1);
				$ok = 0;
			}
			
			#
			# username available?
			#

			if ($ok && users_is_username_taken($username)){

				$smarty->assign('username', '');
				$smarty->assign('error_username_taken', 1);
				$ok = 0;
			}

			if ($ok){
				$new_user = array(
					"username" => $username,
					"fullname" => $fullname,
					"email" => $invite['email'],
					"password" => $tmp_password,
				);
			
				$user = users_create_user($new_user);
				$user = $user['user'];
			}
		}

		# save their address

		if ($ok){
			
			loadlib("users_address");
			
			$street1 = post_str("street1");
			$street2 = post_str("street2");
			$city = post_str("city");
			$state = post_str("state");
			$country = post_str("country");
			$postal_code = post_str("postalcode");


			if ((!strlen($street1)) || (!strlen($city)) || (!strlen($state)) || (!strlen($country)) || (!strlen($postal_code))){

				$smarty->assign('error_missing', 1);
				$ok = 0;
			}

			if ($ok) {
				$address = array(
					"street1" => $street1,
					"street2" => $street2,
					"city" => $city,
					"state" => $state,
					"country" => $country,
					"postcode" => $postal_code,
					"user_id" => $user['id'],
				);
				
				$rsp = users_address_create($address);
				
				if ($rsp['ok']){
					$address = $rsp['address'];
				} else {
					$ok = 0;
					$smarty->assign('error_bad_address', 1);
				}
			}
		}

		
		# create a new "roll" of film
		
		if ($ok){

			loadlib("artisanal_integers");
			loadlib("rolls");

			$roll_id = artisanal_integers_create("brooklyn");
			$roll_id = $roll_id['integer'];

			$now = time();

			$roll = array(
				"id" => $roll_id,
				"user_id" => $user['id'],
				"created" => $now,
			);

			$rsp = rolls_create($roll);

			if ($rsp['ok']){
				$roll = $rsp['roll'];
			} else {
				# wtf?
				error_500();
			}
		}

		# create an order

		if ($ok){
			
			loadlib("orders");

			$now = time();

			$order = array(
				"shipping_address_id" => $address['id'],
				"roll_id" => $roll['id'],
				"created" => $now,
				"user_id" => $user['id'],
			);

			$rsp = orders_create($order);

			if ($rsp['ok']){
				$order = $rsp['order'];
			} else {
				# wtf
				error_500();
			}
		}
		

		# delete the invite code / mark it used
		if ($ok){
			
			$now = time();
			
			$update = array(
				"redeemed" => $now
			);
			
			invite_codes_update($invite, $update);
		
			# send user an email about their order
			$smarty->assign('order', $order);

			$args = array(
				'to_email' => $invite['email'],
				'template' => 'email_order_confirmation.txt',
			);

			$rsp = email_send($args);
			
			# send user to a thank you page
			$smarty->display("page_invite_thank_you.txt");
			exit();
		}
	}

	$smarty->display("page_invite.txt");
	exit();
	
