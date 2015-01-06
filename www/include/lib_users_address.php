<?php

	#################################################################

	function users_address_create($address, $more=array()){

		$hash = array();
		foreach ($address as $k => $v){
			$hash[$k] = AddSlashes($v);
		}

		$ret = db_insert('users_address', $hash);

		if (!$ret['ok']) return $ret;


		#
		# cache the unescaped version
		#

		$address['id'] = $ret['insert_id'];

		cache_set("ADDRESS-{$address['id']}", $address);

		return array(
			'ok'	=> 1,
			'address'	=> $address,
		);

	}

	#################################################################

	function users_address_update(&$address, $update){

	}

	#################################################################

	function users_address_delete(&$address){

	}

	#################################################################

	function users_address_get_by_user($user){

	}

