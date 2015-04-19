<?php

	#################################################################

	function urls_root_url(){

		return $GLOBALS['cfg']['abs_root_url'];
	}


	#################################################################

	function urls_redirect($url){

		header("location: {$url}");
		exit();
	}


	#################################################################

	function urls_admin_url(){
		return "{$GLOBALS['cfg']['abs_root_url']}admin/";
	}

	# the end