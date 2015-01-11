<?php

	#################################################################

	function rolls_create($roll, $more=array()){

		$hash = array();
		foreach ($roll as $k => $v){
			$hash[$k] = AddSlashes($v);
		}

		$ret = db_insert('rolls', $hash);

		if (!$ret['ok']) return $ret;


		#
		# cache the unescaped version
		#

		$roll['id'] = $ret['insert_id'];

		cache_set("ROLL-{$roll['id']}", $roll);

		return array(
			'ok'	=> 1,
			'roll'	=> $roll,
		);

	}

	#################################################################

	function rolls_update(&$roll, $update){

	}

	#################################################################

	function rolls_delete(&$roll){

	}

	#################################################################

	function rolls_get_by_user(&$user){

		$sql = "SELECT * FROM rolls WHERE user_id=".intval($user['id']);

		return db_fetch_paginated($sql, $args);

	}

	#################################################################

	function rolls_get_all(){

		$sql = "SELECT * FROM rolls";

		return db_fetch_paginated($sql);

	}

	#################################################################

	function rolls_get_by_id($roll_id){

		$sql = "SELECT * FROM rolls WHERE id=".intval($roll_id);

		return db_single(db_fetch($sql));

	}
	
	#################################################################
	
	function rolls_get_inflated_roll_by_id($roll_id){
		
		$roll = rolls_get_by_id($roll_id);
		
		# inflate user info
		$user = users_get_by_id($roll['user_id']);
		
		$roll['username'] = $user['username'];
		$roll['fullname'] = $user['fullname'];
		
		return $roll;
	
	}

