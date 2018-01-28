<?php
class Cookie {
	public static function bake($name, $value, $expire = NULL, $path = '/', $domain = NULL) {
		if($expire === NULL) $expire = time() + (30 * 24 * 60 * 60);
		if(!$domain) $domain = '.' . conf('static_base_domain'); // Shared cookie across sub-domains

		//L o g::w('$name: ' . $name . ' | $value: "' . $value . '" | $domain: ' . $domain);
		setcookie($name, $value, $expire, $path, $domain); // has 2 more variables: $secure + $httponly
		$_COOKIE[$name] = $value;
	}

	public static function get($value, $default = NULL) {
		if(empty($_COOKIE[$value])) return $default;
		return self::get_clean($_COOKIE[$value]);
	}

	private static function get_clean($value) {
		return strip_tags(rawurldecode($value));
	}

	public static function is_valid($value) {
		if(!empty($_COOKIE[$value])) return true;
	}
	public static function all() {
		return $_COOKIE;
	}

	public static function forget($cookie_name) {
		if(is_array($cookie_name)) {
			self::_forget_cookies($cookie_name);
			return;
		} else if(empty($_COOKIE[$cookie_name])) return;

		setcookie($cookie_name, '', time() - 1000);
		setcookie($cookie_name, '', time() - 1000, '/');
		setcookie($cookie_name, '', time() - 1000, '/', $domain = '.' . conf('static_base_domain'));
		$_COOKIE[$cookie_name] = '';
	}

	private static function _forget_cookies($cookies_array) {
		foreach($cookies_array as $cookie_name) {
			self::forget($cookie_name);
		}
	}
}
