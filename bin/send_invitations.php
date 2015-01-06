<?php

	include("init_local.php");
	loadlib("invite_codes");
	loadlib("csv");
	loadlib("cli");

	# import email list from ?

	$spec = array(
		"list" => array("flag" => "i", "required" => 1, "help" => "..."),
	);

	$opts = cli_getopts($spec);

	function import_row($row){
		## remove email address to turn off debug mode
		if ($row['Email Address'] == 'micahwalter@gmail.com'){
			$rsp = invite_codes_create($row['Email Address']);
			if (!$rsp['invite']['sent']){
				$rsp = invite_codes_send_invite($rsp['invite'], 'email_invite_codes.txt');
				if ($rsp){
					echo "sent invite to: " . $row['Email Address'] . "\n";
				}
			}
		}
	}

	csv_parse_file($opts['list'], 'import_row');

	exit();
