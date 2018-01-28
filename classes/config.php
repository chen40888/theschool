<?php
class Config {
	private static $conf_value;
	private
		$conf_key,
		$config_array,
		$values_as_array,
		$full_config_path;

	/**
	 * Get a configuration values-array from the configurations folder
	 * First part of the dot notation is the configuration filename
	 * Second part is an optional key that holds the configuration array
	 *
	 * @param string $file_name_and_key
	 * @return array
	 */
	public static function get($file_name_and_key) {
		//Log::w('$file_name_and_key: ' . $file_name_and_key);
		self::$conf_value = array();
		new self($file_name_and_key);

		return self::$conf_value;
	}

	public function __construct($file_name_and_key) {
		$this->_setup($file_name_and_key);
		$this->_set_full_config_path();
		$this->_set_config_array();
		$this->_set_conf_value();
	}

	private function _setup($file_name_and_key) {
		$this->conf_key = $file_name_and_key;
		$this->values_as_array = (strstr($this->conf_key, '.') ? explode('.', $this->conf_key) : array($this->conf_key));
	}

	private function _set_full_config_path() {
		$conf_filename = $this->values_as_array[0];
		$this->full_config_path = ROOT . 'config/' . $conf_filename . '.conf.php';
	}

	private function _set_config_array() {
		if(file_exists($this->full_config_path)) $this->config_array = include $this->full_config_path;
		else Log::write('NOTICE: Failed to find $full_config_path: ' . $this->full_config_path);
	}

	private function _set_conf_value() {
		self::$conf_value = $this->config_array;
		unset($this->values_as_array[0]);

		foreach($this->values_as_array as $value) {
			if(empty(self::$conf_value[$value])) {
				Log::write('NOTICE: Failed to get a value "' . $value . '" | $conf_key: ' . $this->conf_key . ' | $full_config_path: ' . $this->full_config_path);
				self::$conf_value = '';
				break;
			}
			self::$conf_value = self::$conf_value[$value];
		}
	}
}
