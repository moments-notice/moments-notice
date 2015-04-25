<?php

	include("include/init.php");

	login_ensure_loggedin();

	loadlib("admin");
	admin_ensure_authorized_role();

	loadlib("orders");

	if ($page = get_int32("page")){
	   $more['page'] = $page;
	}

	$orders = orders_get_all($more);

	foreach ($orders['rows'] as $key => $order){
		$user = users_get_by_id($order['user_id']);
		$orders['rows'][$key]['username'] = $user['username'];
	}

	$smarty->assign('orders', $orders);
	$smarty->assign("pagination", $orders['pagination']);
	$smarty->display('page_admin_orders.txt');

	exit();
