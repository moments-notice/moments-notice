<?php

	#################################################################

	function lab_log_get_all($more=array()){

		$sql = "SELECT * FROM lab_log ORDER BY id DESC";

		return db_fetch_paginated($sql, $more);

	}
