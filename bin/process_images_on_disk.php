<?php

	#############################################################
	/* command line util to process a folder of images

	 folder of images should be each "frame" in a roll

	 folder should be named for the roll id

	 1) loop through each frame/file in the folder
	 2) get a brooklynt for the photo
	 3) rename the original file with the scheme:

	 	brooklynt_secret_rendition.ext

	 4) create multiple size renditions?

	 5) create a "photo" in the DB

	 6) manually upload to S3 bucket ( for now )

	*/
	#############################################################

	include("init_local.php");
	loadlib("cli");
	loadlib("photos");
	loadlib("artisanal_integers");
	loadlib("random");

	# use command line to select folder


	$spec = array(
		"path" => array("flag" => "p", "required" => 1, "help" => "specify the path to a folder of images"),
		"user" => array("flag" => "u", "required" => 1, "help" => "specify the associated user id"),
		"roll" => array("flag" => "r", "required" => 1, "help" => "specify the roll id"),
	);

	$opts = cli_getopts($spec);

	$files = scandir($opts['path']);

	# count number of images as photos

	foreach ($files as $file){

		if($file !== '.' && $file !== '..'){
			echo "Processing: " . $file . "\n";

			# do all the things

			# get a brooklyn integer
			$brooklynt = artisanal_integers_create("brooklyn");

			# rename it with scheme 

			$secret = random_string(32);

			$fullpath = $opts['path'] . "/" . $file;
			$filename = $brooklynt['integer'] . "_" . $secret . "_o.jpg";
			$newname = $opts['path'] . "/" . $filename;

			echo "Renaming: " . $file . " as: " . $newname . "\n";
			rename($fullpath, $newname);

			# add it to the db
			$photo = array(
				"id" => $brooklynt['integer'],
				"user_id" => $opts['user'],
				"roll_id" => $opts['roll'],
				"filename" => $filename,
				"secret" => $secret,
			);

			echo "Adding " . $brooklyn['integer'] . " to the database \n";
			$rsp = photos_create_photo($photo);
			dumper($rsp);
		}
	}

	exit();

	