<?php

	#################################################################

	function shlong_add_url($long_url, $more=array()){

		if ($row = shlong_get_short_url($long_url)){

			return array(
				'ok' => 1,
				'long_url' => $long_url,
				'short_url' => $row['short_url'],
			);
		}

		$min_length = 4;
		$max_length = 16;

		for ($i = $min_length; $i <= $max_length; $i += 1){

			$short_url = shlong_generate_id($i);

			$enc_long_url = AddSlashes($long_url);
			$enc_short_url = AddSlashes($short_url);

			$urls = array(
				'short_url' => $enc_short_url,
				'long_url' => $enc_long_url,
				);

			$rsp = db_insert('ShlongUrls', $urls);

			if ($rsp['ok']){
				$rsp = array_merge($rsp, $urls);
				return $rsp;
			}
		}

		return array('ok' => 0, 'error' => 'exceed max tries for creating a URL');
	}

	#################################################################

	function shlong_get_urls($more=array()){

		$sql = "SELECT * FROM ShlongUrls ORDER BY shortened DESC";
		$rsp = db_fetch_paginated($sql, $more);

		return $rsp;
	}

	#################################################################

	function shlong_get_long_url($short_url){

		$enc_short_url = AddSlashes($short_url);

		$sql = "SELECT long_url FROM ShlongUrls WHERE short_url='{$enc_short_url}'";

		$rsp = db_fetch($sql);
		$row = db_single($rsp);

		return $row;
	}

	#################################################################

	function shlong_get_short_url($long_url){

		$enc_long_url = AddSlashes($long_url);

		$sql = "SELECT short_url FROM ShlongUrls WHERE long_url='{$enc_long_url}'";

		$rsp = db_fetch($sql);
		$row = db_single($rsp);

		return $row;
	}

	#################################################################

	function shlong_generate_id($length=3){

		$chars = 'qwrtypsdfghjklzxcvbnm0123456789';
		$id = '';

		while (strlen($id) < $length){
			$id .= substr($chars, rand(0, strlen($chars) - 1), 1);
		}

		return $id;

	}

	#################################################################

	function shlong_redirect($redirect_url){

		header("HTTP/1.0 301");
		header("Location: {$redirect_url}");

		exit();
	}

	# the end
