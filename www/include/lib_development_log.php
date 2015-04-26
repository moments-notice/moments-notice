<?php

	#################################################################

	function development_log_create_log($log){

		$log['developed'] = time();

		$hash = array();
		foreach ($log as $k => $v){
			$hash[$k] = AddSlashes($v);
		}

		$ret = db_insert('development_log', $hash);

		if (!$ret['ok']) return $ret;

		return array(
			'ok' => 1,
			'log' => $log,
		);
	}

	#################################################################

	function development_log_get_developed_count(){

		 $sql = "SELECT * from development_log WHERE developed != 0";

		 return db_single(db_fetch($sql));

	}

	#################################################################

	function development_log_get_by_id($log_id){

		$sql = "SELECT * FROM development_log WHERE id=".intval($log_id);

		return db_single(db_fetch($sql));

	}

	#################################################################

	function development_log_get_all($more=array()){

		$sql = "SELECT * FROM development_log ORDER BY id DESC";

		return db_fetch_paginated($sql, $more);

	}

	#################################################################

	function development_log_update(&$log, &$update){

		$hash = array();
		
		foreach ($update as $k => $v){
			$hash[$k] = AddSlashes($v);
		}

		$enc_id = AddSlashes($log['id']);
		$where = "id='{$enc_id}'";

		$rsp = db_update('development_log', $hash, $where);

		return $rsp;
	}
