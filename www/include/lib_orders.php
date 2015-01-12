<?php

	#################################################################

	function orders_create($order, $more=array()){

		$hash = array();
		foreach ($order as $k => $v){
			$hash[$k] = AddSlashes($v);
		}

		$ret = db_insert('orders', $hash);

		if (!$ret['ok']) return $ret;


		#
		# cache the unescaped version
		#

		$order['id'] = $ret['insert_id'];

		cache_set("ORDER-{$order['id']}", $order);

		return array(
			'ok'	=> 1,
			'order'	=> $order,
		);

	}

	#################################################################

	function orders_update(&$order, $update){

	}

	#################################################################

	function orders_delete(&$order){

	}

	#################################################################

	function orders_get_by_user($user){

	}

	#################################################################

	function orders_get_orders_count(){

		 $sql = "SELECT COUNT(*) FROM orders WHERE created != 0";

		 return db_single(db_fetch($sql));

	}

	#################################################################

	function orders_get_orders_shipped(){

		 $sql = "SELECT COUNT(*) FROM orders WHERE shipped != 0";

		 return db_single(db_fetch($sql));

	}