<?

	$GLOBALS['_email_hooks']['send'] = 'email_php_send';
	
	#########################################################################################

	function email_php_send($args){

		$args = email_common_prepare_email($args);

		if (isset($headers['To'])){			
			unset($headers['To']);
		}

		$ok = mail(
			$args['to_email'],
			$args['subject'],
			$args['message'],
			email_utils_format_headers($args['headers']),
			$GLOBALS['cfg']['auto_email_args']
		);

		$rsp = array('ok' => $ok);
		return $rsp;
	}

	#########################################################################################

	# the end
