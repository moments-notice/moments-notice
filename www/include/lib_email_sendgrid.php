<?php

	$GLOBALS['_email_hooks']['send'] = 'email_sendgrid_send';

	#########################################################################################

	# https://github.com/sendgrid/sendgrid-php
	include_once('sendgrid-php/sendgrid-php.php');

	#########################################################################################

	function email_sendgrid_send($args){
		
		$args = email_common_prepare_email($args);
		
		$to = new SendGrid\Email(null, $args['to_email']);

		$from = new SendGrid\Email($args['from_name'], $args['from_email']);

		$subject = $args['subject'];
		$content = new SendGrid\Content("text/html", $args['message']);

		$mail = new SendGrid\Mail($from, $subject, $to, $content);

		$apikey = $GLOBALS['cfg']['sendgrid_api_key'];
		$sg = new \SendGrid($apikey);

		try {
		     $ok = ($sg->client->mail()->send()->post($mail)) ? 1 : 0;
		     $rsp = array('ok' => $ok);
		}

		catch (Exception $e){

			$rsp = array(
				'ok' => 0,
				'error' => $e->getMessage()
			);
		}

		return $rsp;
	}

	#########################################################################################

	# the end
