<?php

class Edit_Course_Table {

	public static function _bring_course($id) {
		$query = "SELECT * FROM courses WHERE id = $id";
		return DB::fetch_row($query);
	}

	public static function _update_course($name, $description, $file ,$id) {
		$query = "UPDATE courses c SET c.name = '$name', c.description = '$description',c.image = '$file' WHERE c.id = '{$id}'";
		DB::execute('UPDATE', $query);
	}
}
