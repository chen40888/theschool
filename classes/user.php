<?php
class User {
	public static
		$id,
		$role,
		$email,
		$gender,
		$id_card,
		$full_name,
		$birth_date,
		$token_date_created;

	public function __construct() {
		$user_array = User_Table::get_user_by_cookie();
//		var_dump($user_array);
		self::$id = ($user_array ? $user_array['id'] : 0);
		self::$role = ($user_array ? $user_array['role'] : 'anonymous');
		self::$email = ($user_array ? $user_array['email'] : '');
		self::$id_card = ($user_array ? $user_array['person_id'] : 0);
		self::$full_name = ($user_array ? $user_array['name'] : 'anonymous');
		self::$birth_date = ($user_array ? $user_array['phone'] : 0);
		self::$token_date_created = ($user_array ? $user_array['password'] : 0);
//echo self::$role;
		//L o g::w($user_array, '$token: ' . Cookie::get('token') . ' | $user_array');
		Log::w('$user_id:' . self::$id . ' | user_role:' . self::$role);
	}
}
