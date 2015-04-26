<?php

	#################################################################

	function lab_log_create_log($log){

		$log['mixing_date'] = time();

		$hash = array();
		foreach ($log as $k => $v){
			$hash[$k] = AddSlashes($v);
		}

		$ret = db_insert('lab_log', $hash);

		if (!$ret['ok']) return $ret;

		return array(
			'ok' => 1,
			'log' => $log,
		);
	}

	#################################################################

	function lab_log_update_log(&$log){

	}

	#################################################################

	function lab_log_delete_log(&$log){

	}

	#################################################################

	function lab_log_get_all($more=array()){

		$sql = "SELECT * FROM lab_log ORDER BY id DESC";

		return db_fetch_paginated($sql, $more);

	}
