<?php

	$GLOBALS['_email_hooks']['send'] = 'email_mandrill_send';

	#################################################################

	# See https://mandrillapp.com/api/docs/index.php.html
	require_once("mandrill-php/Mandrill.php");

	#################################################################

	function email_mandrill_send($args){
		
		if ($args['attachments']){
			$attachments = $args['attachments'];
		}

		$args = email_common_prepare_email($args);

		$mandrill = new Mandrill($GLOBALS['cfg']['mandrill_api_key']);

		if (features_is_enabled("mandrill_proxy")){
				$mandrill->useProxy($GLOBALS['cfg']['mandrill_proxy_address'])->sslVerifyHost(0)->sslVerifyPeer(0);
		}
			
		$mandrill_message = array(
			'html' => $args['message'],
			'text' => $args['message'],
			'subject' => $args['subject'],
			'from_email' => $args['from_email'],
			'from_name' => $args['from_name'],
			'to' => array(array(
				'email' => $args['to_email'],
				'type' => 'to'
			)),
		 	'headers' => $args['headers'],
			'track_opens' => true,
			'track_clicks' => true,
			'auto_text' => true,
			'auto_html' => true,
			'inline_css' => null,
			'url_strip_qs' => null,
			'preserve_recipients' => null,
			'view_content_link' => null,
			'bcc_address' => null,
			'tracking_domain' => null,
			'signing_domain' => null,
			'return_path_domain' => null,
			# 'tags' => array('email resets'),
			'metadata' => array('website' => $GLOBALS['cfg']['abs_root_url']),
		);

		if ($attachments){
			$mandrill_message['attachments'] = $attachments;
		}

		$async = false;
		$ip_pool = 'Main Pool';

		try {

			$m_rsp = $mandrill->messages->send($mandrill_message, $async, $ip_pool);
			$details = $m_rsp[0];

			$ok = ($details['status'] == 'sent') ? 1 : 0;
			$rsp = array('ok' => $ok, 'details' => $details);
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