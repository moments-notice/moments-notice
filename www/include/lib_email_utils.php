<?php

	 #########################################################################################

	function email_utils_format_body($message){

		$message = str_replace("\r", "", $message);
		$message = wordwrap($message, 72);

		return $message;
	}

	#########################################################################################

	function email_utils_quoted_printable($subject){

		if (preg_match('/[^a-z: ]/i', $subject)){
			$subject = preg_replace_callback('/([^a-z ])/i', 'email_utils_quoted_printable_encode', $subject);
			$subject = str_replace(' ', '_', $subject);
			return "=?utf-8?Q?$subject?=";
		}

		return $subject;
	}

	#########################################################################################

	function email_utils_quoted_printable_encode($m){
		return sprintf('=%02x', StripSlashes(ord($m[1])));
	}

	#########################################################################################

	function email_utils_format_headers(&$headers){

		$h2 = array();

		foreach ($headers as $h => $v){
			$h2[] = "$h: $v";
		}

		return implode("\r\n", $h2);
	}

	#########################################################################################

	# the end