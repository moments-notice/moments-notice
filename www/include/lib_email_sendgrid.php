<?php

	$GLOBALS['_email_hooks']['send'] = 'email_sendgrid_send';

	#########################################################################################

	# https://github.com/sendgrid/sendgrid-php
	include_once('sendgrid-php/SendGrid_loader.php');

	#########################################################################################

	function email_sendgrid_send($args){
		
		$args = email_common_prepare_email($args);

		$sendgrid = new SendGrid($GLOBALS['cfg']['email_sendgrid_username'], $GLOBALS['cfg']['email_sendgrid_password']);
		
		$mail = new SendGrid\Mail();
		
		$mail->addTo($args['to_email']);
		$mail->setFrom($args['from_email']);
		$mail->setSubject($args['subject']);
		$mail->setText($args['message']);

		if ($name = $more['from_name']){
			$mail->setFromName($name);
		}

		try {
			$ok = ($sendgrid->smtp->send($mail)) ? 1 : 0;
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
