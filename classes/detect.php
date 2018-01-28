<?php

class Detect {
	private static
		$base_data,
		$static_data;
	private $ua;

	public static function get_static_request_data() {
		if(self::$static_data) return self::$static_data;

		new self;
		//L o g::w(self::$static_data, '$static_data');
		return self::$static_data;
	}

	public static function get_base_data() {
		if(is_array(self::$base_data)) return self::$base_data;

		self::get_static_request_data();

		//L o g::w(self::$base_data, '$base_data');
		return self::$base_data;
	}

	public function __construct() {
		$this->ua = strtolower(serv('HTTP_USER_AGENT'));
		self::$static_data = self::$base_data = array(
			'device' => $this->_get_device_name(),
			'browser' => $this->_get_browser_name(),
			'operating_system' => $this->_get_operating_system_name()
		);
	}

	private function _get_browser_name() {
		return $this->_get_desktop_browser_name();
	}

	private function _get_device_name() {
		return 'Computer';
	}

	private function _get_operating_system_name() {
		return $this->_get_desktop_operating_system_name();
	}

	/**
	 * @see http://stackoverflow.com/a/20934782/4255615
	 * @return string Browser name
	 */
	private function _get_desktop_browser_name() {
		//Log::w('ua: ' . $this->ua);
		if(strpos($this->ua, 'safari/') && strpos($this->ua, 'opr/')) return 'Opera';
		else if(strpos($this->ua, 'safari/') && strpos($this->ua, 'chrome/')) return 'Chrome';
		else if(strpos($this->ua, 'msie') && strpos($this->ua, 'trident')) {
			$split = explode(' ', strstr($this->ua, 'msie'));
			$ie_version = (int) $split[1]; // Set Browser Version
			return 'Internet Explorer ' . $ie_version;
		}
		else if(strpos($this->ua, 'firefox/')) return 'Firefox';
		else if(strpos($this->ua, 'safari/') && strpos($this->ua, 'opr/') === false && strpos($this->ua, 'chrome/') === false) return 'Safari';
		else return 'Unknown';
	}

	/**
	 * @see stackoverflow.com/questions/647969/detect-exact-os-version-from-browser
	 * @return string Operating System name
	 */
	private function _get_desktop_operating_system_name() {
		$oses = array(
			'Win311' => 'Win16',
			'Win95' => '(Windows 95)|(Win95)|(Windows_95)',
			'WinME' => '(Windows 98)|(Win 9x 4.90)|(Windows ME)',
			'Win98' => '(Windows 98)|(Win98)',
			'Win2000' => '(Windows NT 5.0)|(Windows 2000)',
			'WinXP' => '(Windows NT 5.1)|(Windows XP)',
			'WinServer2003' => '(Windows NT 5.2)',
			'WinVista' => '(Windows NT 6.0)',
			'Windows 7' => '(Windows NT 6.1)',
			'Windows 8' => '(Windows NT 6.2)',
			'Windows 10' => '(Windows NT 10.0)',
			'WinNT' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
			'OpenBSD' => 'OpenBSD',
			'SunOS' => 'SunOS',
			'Ubuntu' => 'Ubuntu',
			'Android' => 'Android',
			'Linux' => '(Linux)|(X11)',
			'iPhone' => 'iPhone',
			'iPad' => 'iPad',
			'MacOS' => '(Mac_PowerPC)|(Macintosh)',
			'QNX' => 'QNX',
			'BeOS' => 'BeOS',
			'OS2' => 'OS/2',
			'SearchBot' => '(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp)|(MSNBot)|(Ask Jeeves/Teoma)|(ia_archiver)'
		);

		foreach($oses as $os => $pattern) {
			if(preg_match('/' . $pattern . '/i', $this->ua)) return $os;
		}
		return 'Unknown';
	}
}
