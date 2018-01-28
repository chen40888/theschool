<?php
class Session {
	public static $id;
	private static $exam_id, $user_id;

	public static function set_session_id($exam_id, $user_id) {
		self::$exam_id = $exam_id;
		self::$user_id = $user_id;
		self::$id = Cookie::get('session_id');
		if(!self::$id) self::_on_no_session_cookie();
	}

	private static function _on_no_session_cookie() {
		self::$id = Exam_Session_Table::get_last_in_progress_session_id(self::$user_id, self::$exam_id);
		//Log::w('$id: ' . self::$id);
		if(!self::$id) self::_create_a_new_session();
		else Cookie::bake('session_id', self::$id);
	}

	private static function _create_a_new_session() {
		Exam_Session_Table::start_a_new_session(self::$user_id, self::$exam_id);
		self::$id = DB::last_insert_id();
		Cookie::bake('session_id', self::$id);
	}
}
