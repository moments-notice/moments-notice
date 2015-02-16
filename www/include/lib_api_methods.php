<?php

	##############################################################################

	# God... I don't really know what to call this (20140306/straup)

	function api_methods_is_class_special_snowflake($class){

		return (preg_match("/^(api|tessitura)\./", $class)) ? 0 : 1;
	}

	##############################################################################

	function api_methods_can_view_method(&$method, $viewer_id=0){

		$see_all = (auth_has_role("admin", $viewer_id)) ? 1 : 0;
		$see_undocumented = (auth_has_role_any(array("admin", "api"), $viewer_id)) ? 1 : 0;

		if ((! $method['enabled']) && (! $see_all)){
			return 0;
		}

		if (is_array($method['documented_if'])){

			$required = $method['documented_if'];

			if (! in_array("admin", $required)){
				$required[] = "admin";
			}

			if (! auth_has_role_any($required, $viewer_id)){
				return 0;
			}
		}

		else if ((! $method['documented']) && (! $see_all)){
			return 0;
		}

		else {}

		return 1;
	}

	##############################################################################

	# the end
