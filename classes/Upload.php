<?php

new Upload;
class Upload {
	public function __construct() {
		try {
			$this->_do_upload();
		} catch(Exception $exception_object) {
			Log::w($exception_object);
//			echo $exception_object->getMessage();
		}
	}

	private function _do_upload() {
		$target_dir = ROOT . 'img/';
		$target_file = $target_dir . basename(Files::get('name', 'default'));
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

		Log::w('$tmp_name: ' . Files::get('tmp_name'));


		// Check if image file is a actual image or fake image
		$check = getimagesize(Files::get('tmp_name'));
		if($check === false) {
			throw new Exception('File is not an image');
			$uploadOk = 0;
		}

		// Check if file already exists
		if (file_exists($target_file)) {
			throw new Exception('Sorry, file already exists.');
			$uploadOk = 0;
		}
		// Check file size
		if (Files::get('size') > 500000) {
			throw new Exception('Sorry, your file is too large');
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg'
			&& $imageFileType != 'gif' ) {
			throw new Exception('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			throw new Exception('Sorry, your file was not uploaded.');
			// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file(Files::get('tmp_name'), $target_file)) {
				echo 'The file '. basename(Files::get('name')). ' has been uploaded.';
			} else {
				throw new Exception('Sorry, your file was eror not uploaded.');
			}
		}
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
