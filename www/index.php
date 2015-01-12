<?php
	include('include/init.php');

	loadlib("orders");
	loadlib("development_log");

	$orders_count = orders_get_orders_count();
	
	$stats = array();

	$stats['orders'] = $orders_count['COUNT(*)'];
	if(! $orders_count['COUNT(*)']){
	     $stats['orders'] = 0;
	}

	$orders_shipped = orders_get_orders_shipped();

	$stats['shipped'] = $orders_shipped['COUNT(*)'];
	if(! $orders_shipped['COUNT(*)']){
	     $stats['shipped'] = 0;
	}

	$developed = development_log_get_developed_count();
	$stats['developed'] = $developed['COUNT(*)'];
	if(! $developed['COUNT(*)']){
	     $stats['developed'] = 0;
	}


	$smarty->assign('stats', $stats);
	$GLOBALS['smarty']->display('page_index.txt');
	exit();

