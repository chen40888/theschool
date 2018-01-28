<?php
class Curl {
	private static $response;
	private
		$is_xml,
		$timeout,
		$request_url,
		$curl_handle,
		$post_request,
		$curl_options,
		$to_file_path,
		$file_pointer,
		$headers_string = '';

	public static function send($request_url, $post_request = NULL, $is_xml = false, $to_file_path = false, $timeout = 60) {
		new self($request_url, $post_request, $is_xml, $to_file_path, $timeout);
		return self::$response;
	}

	private function __construct($request_url, $post_request, $is_xml, $to_file_path, $timeout) {
		$this->request_url = $request_url;
		$this->post_request = $post_request;
		$this->is_xml = $is_xml;
		$this->to_file_path = $to_file_path;
		$this->timeout = $timeout;

		$this->_convert_post_array_to_string();
		$this->_setup_curl_options_request();
		$this->_send_request();
	}

	private function _convert_post_array_to_string() {
		if(is_array($this->post_request)) $this->post_request = urldecode(http_build_query($this->post_request));
	}

	private function _send_request() {
		//Log::w('$request_url: "' . $this->request_url . '"');
		$this->curl_handle = curl_init();
		curl_setopt_array($this->curl_handle, $this->curl_options);
		self::$response = trim(curl_exec($this->curl_handle));
		//Log::w('$response: ' . self::$response);
		//L o g::w('headers_string:' . trim($this->headers_string));

		if(empty(self::$response)) {
			$http_code = curl_getinfo($this->curl_handle, CURLINFO_HTTP_CODE);
			$error_description = curl_error($this->curl_handle);
			self::$response = array('error' => true, 'error_code' => 100, 'error_description' => $error_description, 'http_code' => $http_code);
		}

		curl_close($this->curl_handle);
	}

	private function _setup_curl_options_request() {
		$this->curl_options = array(
			CURLOPT_RETURNTRANSFER => true, // TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
			CURLOPT_FRESH_CONNECT => true, // TRUE to force the use of a new connection instead of a cached one.
			CURLOPT_FORBID_REUSE => true, // TRUE to force the connection to explicitly close when it has finished processing, and not be pooled for reuse.
			CURLOPT_CONNECTTIMEOUT => 60, // The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.
			CURLOPT_TIMEOUT => $this->timeout, // The maximum number of seconds to allow cURL functions to execute.
			CURLOPT_FAILONERROR => true, // Fail verbosely if the HTTP code returned is >= 400. (default = return the page normally, ignoring the code)
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $this->post_request,
			CURLOPT_URL => $this->request_url,
			CURLOPT_HEADERFUNCTION => array($this, '_handle_curl_header_callback') // A callback function called for each response header parameter. The callback must return the number of bytes written
		);

		if($this->to_file_path) $this->_create_file_and_add_to_curl();
		if($this->is_xml) $this->_set_xml_request_headers();
		else $this->_set_request_headers();
	}

	// http://stackoverflow.com/questions/6409462/downloading-a-large-file-using-curl
	private function _create_file_and_add_to_curl() {
		set_time_limit(0); // Limits the maximum execution time | If set to zero, no time limit is imposed.
		$this->file_pointer = fopen($this->to_file_path, 'w+'); // Save the the response in this file
		$this->curl_options[CURLOPT_FILE] = $this->file_pointer;
	}

	private function _set_request_headers() {
		$this->curl_options[CURLOPT_HTTPHEADER] = array(
			'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
			'Accept-Language: en-US,en;q=0.5',
			'Cache-Control: max-age=0',
			'Connection: keep-alive'
		);
	}

	private function _set_xml_request_headers() {
		$this->curl_options[CURLOPT_HTTPHEADER] = array(
			'Accept: application/xml'
		);
	}

	// A callback function called for each response header parameter. The callback must return the number of bytes written:
	private function _handle_curl_header_callback($curl_handle, $single_header_param) {
		$trimmed_header = trim($single_header_param);
		if(empty($trimmed_header)) return strlen($single_header_param);

		$this->headers_string .= $single_header_param;

		//L o g::w('"single_header_param": ' . $trimmed_header);
		return strlen($single_header_param);
	}
}
