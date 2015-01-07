<?php

	include("init_local.php");

		$args = array(
			'to_email' => 'micah@micahwalter.com',
			'template' => 'email_template.txt',
		);


		$rsp = email_send($args);
		dumper($rsp);
		exit();