<?php

	########################################################################

	function auth_has_role($role, $who=0){

		$who = ($who) ? $who : $GLOBALS['cfg']['user']['id'];

		if (! $who){
			return 0;
		}

		if (! isset($GLOBALS['cfg']['auth_users'][$who])){
			return 0;
		}

		$details = $GLOBALS['cfg']['auth_users'][$who];
		$roles = $details['roles'];

		return (in_array($role, $roles)) ? 1 : 0;
	}

	########################################################################

	function auth_has_role_any($roles, $who=0){

		if (! is_array($roles)){
			return 0;
		}

		foreach ($roles as $role){

			if (auth_has_role($role, $who)){
				return 1;
			}
		}

		return 0;
	}

	########################################################################

	function auth_has_role_all($roles, $who=0){

		if (! is_array($roles)){
			return 0;
		}

		foreach ($roles as $role){

			if (! auth_has_role($role, $who)){
				return 0;
			}
		}

		return 1;
	}

	########################################################################

	# Not sure about these... (20140113/straup)

	function auth_is_admin($user_id=0){
		$roles = array('admin');
		return (auth_has_role_any($roles, $user_id)) ? 1 : 0;
	}

	function auth_is_staff($user_id=0){

		$roles = array('admin', 'staff');
		return (auth_has_role_any($roles, $user_id)) ? 1 : 0;
	}

	########################################################################

	# the end
