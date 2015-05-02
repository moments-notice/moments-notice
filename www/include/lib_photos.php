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

	#######################################################

	function photos_get_photo_by_id($id){

		$sql = "SELECT * FROM photos WHERE id=".intval($id);

		return db_single(db_fetch($sql));

	}

	#######################################################

	function photos_get_photos_by_roll($roll_id, $more=array()){

		$sql = "SELECT * FROM photos WHERE roll_id=".intval($roll_id);

		return db_fetch_paginated($sql, $more);

	}

