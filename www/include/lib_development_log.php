<?php

	#################################################################

	function development_log_get_developed_count(){

		 $sql = "SELECT * from development_log WHERE developed != 0";

		 return db_single(db_fetch($sql));

	}