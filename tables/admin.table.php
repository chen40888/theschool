<?php

class Admin_Table {

	public static function get_all_users() {
		$query = "SELECT * FROM users";
		return DB::fetch_all($query);
	}

	public static function get_manager_and_sales() {
		$query = "SELECT * FROM users WHERE role = 'manager' OR role = 'sales'";
		return DB::fetch_all($query);
	}

}
