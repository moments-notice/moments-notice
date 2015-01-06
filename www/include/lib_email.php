<?php

	$GLOBALS['_email_hooks'] = array(
		'send' => null
	);

	#################################################################

	loadlib("email_common");
	loadlib("email_utils");

	#################################################################

	function email_send($args){
		
		if (! $GLOBALS['_email_hooks']['send']){
			return array('ok' => 0, 'error' => 'No send handler defined');
		}

		$rsp = call_user_func($GLOBALS['_email_hooks']['send'], $args);
		return $rsp;
	}

	#################################################################

	# the end