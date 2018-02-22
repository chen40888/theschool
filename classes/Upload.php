<?php
class Upload {
	private static $is_init;
	public static $is_upload_success;

	public function __construct() {
		if(!self::$is_init) $this->_do_upload();
	}

	private function _do_upload() {
		self::$is_init = true;
		Log::w($_FILES);

		if(Request::get('course_name')) $target_dir = conf('path.courses');
		else if(Request::get('student_name')) $target_dir = conf('path.students');
		else $target_dir = conf('path.users');

		$target_file = $target_dir . basename(Files::get('name', 'default'));
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		//Log::w('$tmp_name: ' . Files::get('tmp_name'));

		$check = getimagesize(Files::get('tmp_name'));
		if(!$check) throw new Custom_Exception(Upload_Exception::$file_is_not_an_image);
		if(file_exists($target_file)) throw new Custom_Exception(Upload_Exception::$file_already_exists);
		if(Files::get('size') > 500000) throw new Custom_Exception(Upload_Exception::$file_too_large);
		if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
			throw new Custom_Exception(Upload_Exception::$bad_file_type_only_allow_jpg_jpeg_png_gif);
		}

		if(move_uploaded_file(Files::get('tmp_name'), $target_file)){
			self::$is_upload_success = TRUE;
			Request::$command_name = str_replace('Command', 'Page', Request::$command_name);
		}
		//Response::die_with_response(array('message' => 'The file '. basename(Files::get('name')). ' has been uploaded.'));
		else throw new Custom_Exception(Upload_Exception::$general_upload_error);
	}
}

class Files {
	public static function get($key, $default = NULL) {
		return (!empty($_FILES['file'][$key]) ? $_FILES['file'][$key] : $default);
	}

	public static function set($key, $value) {
		$_FILES['file'][$key] = $value;
	}
}
