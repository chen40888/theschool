<?php
class Sql_Helper {
	private static $keys_sql;

	public static function insert_or_update($table_name, $keys_array, $fields_array = false) {
		if(self::_is_row_exists($table_name, $keys_array)) self::_update_row($table_name, $keys_array, $fields_array);
		else self::_insert_new_row($table_name, $fields_array);
	}

	private static function _is_row_exists($table_name, $keys_array) {
		$key_value_sql = Sql_Helper::_build_key_value_sql($keys_array, 'AND ');
		self::$keys_sql = $key_value_sql;

		$sql = "SELECT EXISTS(SELECT 1 FROM $table_name WHERE {$key_value_sql} LIMIT 1)";
		$is_row_exists = !!(DB::fetch_value($sql));
		return $is_row_exists;
	}

	private static function _update_row($table_name, $keys_array, $fields_array) {
		$key_value_sql = Sql_Helper::_build_key_value_sql($fields_array, ', ', $keys_array);
		$keys_sql = self::$keys_sql;
		$sql = "UPDATE {$table_name} SET {$key_value_sql} WHERE {$keys_sql} LIMIT 1";
		DB::execute('UPDATE', $sql);
	}

	private static function _insert_new_row($table_name, $fields_array) {
		$array_keys = implode(", ", array_keys($fields_array));
		$array_values = "'" . implode("', '", array_values($fields_array)) . "'";

		$sql = "INSERT INTO {$table_name} ({$array_keys}) VALUES({$array_values})";
		DB::execute('INSERT', $sql);
	}

	private static function _build_key_value_sql($fields_array, $delimiter = ', ', $exclude_keys = array()) {
		$sql = '';
		$index = 0;
		foreach($fields_array as $key => $value) {
			if(!in_array($key, $exclude_keys)) {
				$sql .= ($index ? $delimiter : '') . "{$key} = '{$value}' ";
			}
			$index++;
		}
		return $sql;
	}
}
