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
		$token = Cookie::get('token');
		$user_array = User_Table::get_user_params_by_token($token);
		self::$id = ($user_array ? $user_array['id'] : 0);
		self::$role = ($user_array ? $user_array['role'] : 'anonymous');
		self::$email = ($user_array ? $user_array['email'] : '');
		self::$id_card = ($user_array ? $user_array['id_card'] : 0);
		self::$gender = ($user_array ? $user_array['gender'] : 'male');
		self::$full_name = ($user_array ? $user_array['full_name'] : 'anonymous');
		self::$birth_date = ($user_array ? $user_array['birth_date'] : 0);
		self::$token_date_created = ($user_array ? $user_array['date_created'] : 0);

		//L o g::w($user_array, '$token: ' . Cookie::get('token') . ' | $user_array');
		//Log::w('$user_id:' . self::$id . ' | user_role:' . self::$role);
	}
}
