<?php
class Lang {
	public static function get($category, $key = NULL) {
		return (!$key ? Config::get('localization.' . $key) : Config::get('localization.' . $category . '.' . $key));
	}
}
