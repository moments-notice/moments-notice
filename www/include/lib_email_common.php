<?php

	########################################################################

	function email_common_prepare_email(&$args){

		$headers = array();

		if (is_array($args['headers'])){
			$headers = $args['headers'];
		}

		if ($args['from_name'] && $args['from_email']){

			$from_email = $args['from_email'];
			$from_name = $args['from_name'];

		}

		else if ($args['from_email']){

	   		$from_email = $args['from_email'];
		   	$from_name = $args['from_email'];

		}

		else if ($args['from_name']){

	   		$from_email = $GLOBALS['cfg']['email_from_email'];
		   	$from_name = $args['from_name'];

   		}

		else{

			$from_email = $GLOBALS['cfg']['email_from_email'];
		   	$from_name = $GLOBALS['cfg']['email_from_name'];
   		}

		$headers['From'] = "\"" . email_utils_quoted_printable($from_name) . "\" <$from_email>";

		if (!$headers['To']){
			$headers['To'] = $args['to_email'];
		}

		if (!$headers['Reply-To']){
			$headers['Reply-To'] = $from_email;
		}

		if (!$headers['Content-Type']){
			$headers['Content-Type'] = 'text/plain; charset=utf-8';
		}


		$message = trim($GLOBALS['smarty']->fetch($args['template']));
		$subject = trim($GLOBALS['smarty']->get_template_vars('email_subject'));
	
		$message = email_utils_format_body($message);
		$subject = email_utils_quoted_printable($subject);

		return array(
			'to_email' => $args['to_email'],
			'from_email' => $from_email,
			'from_name' => $from_name,
			'subject' => $subject,
			'message' => $message,
			'headers' => $headers,
		);
	}

	########################################################################

	# the end