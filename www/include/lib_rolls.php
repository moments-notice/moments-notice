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

	function rolls_get_by_user($user){

	}

