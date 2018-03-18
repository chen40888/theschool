<?php
class Upload {
	public static $is_upload_success;

	public function __construct() {
		//Log::w($_FILES, '$_FILES');
		$this->_validate_php_file_upload();

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

		$is_upload_success = move_uploaded_file(Files::get('tmp_name'), $target_file);
		if(!$is_upload_success) throw new Custom_Exception(Upload_Exception::$general_upload_error);
	}

	private function _validate_php_file_upload() {
		//L o g::w($_FILES['file'], '$_FILES[file]');
		if(Files::get('error') === 0) return;
		else if(Files::get('error') == 1) throw new Custom_Exception(Upload_Exception::$apache__invalid_file_size_too_big);
		else if(Files::get('error') == 4) throw new Custom_Exception(Upload_Exception::$apache__no_file_was_uploaded);
		else if(Files::get('error') == 6) throw new Custom_Exception(Upload_Exception::$apache__error_accessing_temp_file);
		else if(Files::get('error') == 7) throw new Custom_Exception(Upload_Exception::$apache__failed_to_open_output_stream);
		else if(Files::get('error') == 8) throw new Custom_Exception(Upload_Exception::$apache__a_php_extension_stopped_the_file_upload);
	}
}
