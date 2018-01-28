<?php
class Custom_Exception extends Exception {

	/**
	 * Custom_Exception constructor.
	 * @param array $error_array
	 * @param string $extra_parameters
	 */
	public function __construct($error_array, $extra_parameters = '') {
		$error_array = (array) $error_array;
		$description = $error_array['desc'] . ' ' . $extra_parameters;

		if(($error_array['severity']) == 'warning') Response::die_with_response(array('warning_translation' => Lang::get('warnings', $error_array['desc'])));
		else if(!empty($error_array['redirect'])) Response::die_with_redirect($error_array['redirect'], 'custom_exception');

		Log::write($error_array, '$error_array');
		Error_Handler::run_on_custom_exception($error_array['id'], $description, $error_array['class_name']);
	}
}
