<?php

	admin_init_admin();

	########################################################################

	function admin_init_admin(){

		admin_ensure_authorized_role();

		$GLOBALS['cfg']['is_admin'] = 1;

	}

	########################################################################

	function admin_ensure_authorized_role(){

		if (! auth_is_admin()){
			urls_redirect($GLOBALS['cfg']['abs_root_url']);
		}

		return 1;
	}

	########################################################################

	function admin_is_admin(){

		if (! preg_match("/^\/admin\//", $_SERVER['REQUEST_URI'])){
			return 0;
		}

		if (! auth_has_role('admin')){
			return 0;
		}

		return 1;
	}

	########################################################################

	# the end