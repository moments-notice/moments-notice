<?php

	loadlib("artisanal_integers");

	#######################################################

	function photos_create_photo($photo){

		$photo['created'] = time();

		if ( !$photo['id'] ){
			# assign brooklynt
			$brooklynt = artisanal_integers_create("brooklyn");
			$photo['id'] = $brooklyn['integer'];
		}

		$hash = array();
		foreach ($photo as $k => $v){
			$hash[$k] = AddSlashes($v);
		}

		$ret = db_insert('photos', $hash);

		if (!$ret['ok']) return $ret;

		return array(
			'ok' => 1,
			'photo' => $photo,
		);

	}

	#######################################################

	function photos_update_photo(&$photo, $update){

	}

	#######################################################

	function photos_delete_photo(&$photo){

	}

