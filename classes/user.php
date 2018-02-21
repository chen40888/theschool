<?php
class User {
	public static
		$id,
		$role,
		$name,
		$email,
		$image,
		$phone,
		$id_card,
		$token_date_created;

	public function __construct() {
		$user_array = Users_Table::get_user_params_by_token(Cookie::get('token'));
		self::$id = ($user_array ? $user_array['id'] : 0);
		self::$phone = ($user_array ? $user_array['phone'] : 0);
		self::$email = ($user_array ? $user_array['email'] : '');
		self::$id_card = ($user_array ? $user_array['person_id'] : 0);
		self::$role = ($user_array ? $user_array['role'] : 'anonymous');
		self::$name = ($user_array ? $user_array['name'] : 'anonymous');
		self::$image = ($user_array ? $user_array['image'] : 'anonymous');
		self::$token_date_created = ($user_array ? $user_array['token_date_created'] : 0);

		//L o g::w($user_array, '$token: ' . Cookie::get('token') . ' | $user_array');
		//Log::w('$user_id:' . self::$id . ' | user_role:' . self::$role);
	}
}
