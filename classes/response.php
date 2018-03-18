<?php
class Response {
	public static
		$data; // array

	public function __construct() {
		if(Request::$is_page_view) {
			//Log::w('Prevented response from serving inside an iframe');
			header('X-Frame-Options: SAMEORIGIN');
		}
	}

	public static function put($key, $value = NULL) {
		if(is_array($key) || is_object($key)) self::_parse_response_key_array_or_object($key);
		else {
			//Log::caller($value, '$key: ' . $key . ' | $value');
			if(!empty(self::$data[$key]) && is_array(self::$data[$key]) && is_array($value)) {
				self::$data[$key] = array_merge(self::$data[$key], $value);
			}
			else self::$data[$key] = $value;
		}
	}

	public static function all() {
		return get_class_vars('Response');
	}

	public static function reset_response_data() {
		self::$data = array();
	}

	public static function die_with_error($error_array) {
		$data = get_class_vars('Response');
		if(!empty($data['data'])) $error_array = array_merge($error_array, $data);

		$response = json_encode($error_array);
		if(Request::$is_page_view && !Request::$is_cron_or_cli) die('Error loading page:<br>' . $response);
		else die($response);
	}

	public static function die_with_redirect($page_name, $reason = '') {
		$redirect_to_url = conf('base_url') . $page_name;
		Log::w('$redirect_to_url: "' . $redirect_to_url . '"' . ' | $reason: ' . $reason);

		$current_page_name = Request::get('arg0', 'login');
		if($current_page_name != $page_name) header('Location: ' . $redirect_to_url);
		die();

	}

	public static function die_with_templated_page($page_name, $template_data) {
		self::_set_response_headers();
		//Log::w('$page_name: ' . $page_name);
		die(Template::get_page($page_name, $template_data));
	}

	public static function die_with_html_page($body, $title = '') {
		self::_set_response_headers();
		die(Template::get_page('simple', array(	'title' => $title, 'body' => $body)));
	}

	public static function die_with_html($html) {
		die($html);
	}

	/*
	 * Die with a HTML or JSON response
	 */
	public static function die_with_response($response_data = NULL, $optional_value = NULL) {
		if($response_data) self::put($response_data, $optional_value);
		Response::put('version', conf('version'));

		//L o g::w(self::$data['user'], 'user');

		self::_set_response_headers();
		//L o g::w(get_object_vars(self::$instance), '$response_array');
		$response = Response::all();
		$response['error'] = false;
		if(empty($response['data'])) $response['data'] = 'No results found';

		//L o g::w($response, 'response');
		$response = json_encode($response);
		if(Request::$is_page_view && !Request::$is_cron_or_cli) die('Error loading page:<br>' . $response);
		else die($response);
	}

	// On CORS requests, some browsers send a pre-flight request with an "Origin" (requester) header to check if it's allowed to make the request for a specified resource
	// Thus, each single request is comprised of 2 actual requests: one OPTIONS and the other actual one (GET/POST)
	public static function die_on_an_options_request() {
		if(serv('REQUEST_METHOD') == 'OPTIONS') {
			//Log::w($_SERVER, '$_SERVER');
			Response::die_with_html('OK');
		}
	}

	private static function _parse_response_key_array_or_object($data) {
		foreach($data as $key => $value) {
			self::put($key, $value);
		}
	}

	private static function _set_response_headers() {
		if(!Request::$is_page_view) {
			header('Content-type: application/json');
			header('Content-Disposition: inline; filename="files.json"');
		}
		header('Vary: Accept');
		header('Pragma: no-cache');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0', false);
		header('X-Content-Type-Options: nosniff'); // Prevent Internet Explorer from MIME-sniffing the content-type
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: ' . gmdate(conf('date.last_modified')) . ' GMT');
	}
}
