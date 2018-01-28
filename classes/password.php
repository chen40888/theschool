<?php
/*
 *	Modified into a class by Alon Goldberg
 *	A Compatibility library with PHP 5.5's simplified password hashing API.
 *	FULL documentation:  https://wiki.php.net/rfc/password_hash
 *
 *	Password Hashing is a way to convert a user-supplied password into a one-way derived token for storage. By using the derived token, it makes it impossible to reverse the
 *	stored token and get the original password used by the user. This adds a layer of defense in case an attacker gets access to the database storing the password.
 *	By using an algorithm designed to be slow such as bcrypt, a much better defense against brute forcing will be had, since sha512() isn't good enough when the salt is known.
 *
 *	There is no requirement for a salt to be true random.
 * * * *
 *	@author Anthony Ferrara <ircmaxell@php.net>
 *	@license http://www.opensource.org/licenses/mit-license.html MIT License
 *	@copyright 2012 The Authors
 *
 * 	To create a password hash from a password, simply use the `password_hash` function:
 *
 * 	$hash = Password::hash($password);
 *
 *	Note that the algorithm that we chose is `PASSWORD_BCRYPT`. That's the current strongest algorithm supported. This is the `BCRYPT` crypt algorithm. It produces a 60 character hash as the result.
 *	'BCRYPT' also allows for you to define a `cost` parameter in the options array. This allows for you to change the CPU cost of the algorithm:
 *	$hash = password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);
 * 	That's the same as the default. The cost can range from `4` to `31`. I would suggest that you use the highest cost that you can, while keeping response time reasonable
 * 	(I target between 0.1 and 0.5 seconds for a hash, depending on use-case).
 *
 *	Another algorithm name is supported: PASSWORD_DEFAULT
 *	This will use the strongest algorithm available to PHP at the current time. Presently, this is the same as specifying `PASSWORD_BCRYPT`. But in future versions of PHP,
 *	it may be updated to use a stronger algorithm if one is introduced. It can also be changed if a problem is identified with the BCRYPT algorithm. Note that if you use this option,
 *	you are **strongly** encouraged to store it in a `VARCHAR(255)` column to avoid truncation issues if a future algorithm increases the length of the generated hash.
 *	It is very important that you should check the return value of `password_hash` prior to storing it, because a `false` may be returned if it encountered an error.
 */
define('PASSWORD_BCRYPT', 1);
define('PASSWORD_DEFAULT', PASSWORD_BCRYPT);

class Password {
	/*
	 * Hash the password using the specified algorithm
	 *
	 * @param string $password The password to hash
	 * @param int    $algo     The algorithm to use (Defined by PASSWORD_* constants)
	 * @param array  $options  The options for the algorithm to use
	 *
	 * @return string|false The hashed password, or false on error.
	 */
	// Password::hash($password);
	public static function hash($password, $algo = 1, array $options = array()) {
		// 1=PASSWORD_BCRYPT
		if(!function_exists('crypt')) {
			//Log::w("Crypt must be loaded for password_hash to function");
			return NULL;
		}
		if(!is_string($password)) {
			//Log::w("password_hash(): Password must be a string");
			return NULL;
		}
		if(!is_int($algo)) {
			//Log::w("password_hash() expects parameter 2 to be long, " . gettype($algo) . " given");
			return NULL;
		}

		$password = trim($password);
		switch ($algo) {
			case PASSWORD_BCRYPT:
				// Note that this is a C constant, but not exposed to PHP, so we don't define it here.
				$cost = 10;
				if (isset($options['cost'])) {
					$cost = $options['cost'];
					if ($cost < 4 || $cost > 31) {
						trigger_error(sprintf("password_hash(): Invalid bcrypt cost parameter specified: %d", $cost), E_USER_WARNING);
						return null;
					}
				}
				// The length of salt to generate
				$raw_salt_len = 16;
				// The length required in the final serialization
				$required_salt_len = 22;
				$hash_format = sprintf("$2y$%02d$", $cost);
				break;
			default:
				trigger_error(sprintf("password_hash(): Unknown password hashing algorithm: %s", $algo), E_USER_WARNING);
				return null;
		}
		if(isset($options['salt'])) {
			switch (gettype($options['salt'])) {
				case 'NULL':
				case 'boolean':
				case 'integer':
				case 'double':
				case 'string':
					$salt = (string) $options['salt'];
					break;
				case 'object':
					if (method_exists($options['salt'], '__tostring')) {
						$salt = (string) $options['salt'];
						break;
					}
				case 'array':
				case 'resource':
				default:
					trigger_error('password_hash(): Non-string salt parameter supplied', E_USER_WARNING);
					return null;
			}
			if (strlen($salt) < $required_salt_len) {
				trigger_error(sprintf("password_hash(): Provided salt is too short: %d expecting %d", strlen($salt), $required_salt_len), E_USER_WARNING);
				return null;
			} elseif (0 == preg_match('#^[a-zA-Z0-9./]+$#D', $salt)) {
				$salt = str_replace('+', '.', base64_encode($salt));
			}
		} else {
			$buffer = '';
			$buffer_valid = false;
			if (function_exists('mcrypt_create_iv') && !defined('PHALANGER')) {
				$buffer = mcrypt_create_iv($raw_salt_len, MCRYPT_DEV_URANDOM);
				if ($buffer) {
					$buffer_valid = true;
				}
			}
			if (!$buffer_valid && function_exists('openssl_random_pseudo_bytes')) {
				$buffer = openssl_random_pseudo_bytes($raw_salt_len);
				if ($buffer) {
					$buffer_valid = true;
				}
			}
			if (!$buffer_valid && is_readable('/dev/urandom')) {
				$f = fopen('/dev/urandom', 'r');
				$read = strlen($buffer);
				while ($read < $raw_salt_len) {
					$buffer .= fread($f, $raw_salt_len - $read);
					$read = strlen($buffer);
				}
				fclose($f);
				if ($read >= $raw_salt_len) {
					$buffer_valid = true;
				}
			}
			if (!$buffer_valid || strlen($buffer) < $raw_salt_len) {
				$bl = strlen($buffer);
				for ($i = 0; $i < $raw_salt_len; $i++) {
					if ($i < $bl) {
						$buffer[$i] = $buffer[$i] ^ chr(mt_rand(0, 255));
					} else {
						$buffer .= chr(mt_rand(0, 255));
					}
				}
			}
			$salt = str_replace('+', '.', base64_encode($buffer));
		}
		$salt = substr($salt, 0, $required_salt_len);

		$hash = $hash_format . $salt;

		$ret = crypt($password, $hash);

		if (!is_string($ret) || strlen($ret) <= 13) {
			return false;
		}

		return $ret;
	}

	/**
	 * Verify a password against a hash using a timing attack resistant approach
	 *
	 * @param string $password The password to verify
	 * @param string $hash     The hash to verify against
	 *
	 * @return boolean If the password matches the hash
	 */
	// Password::verify($password, $hash);
	public static function verify($password, $hash) {
		//Log::w('$password_to_verify: ' . $password . ' | $hash_to_verify_against: ' . $hash);

		if(!function_exists('crypt')) {
			trigger_error("Crypt must be loaded for password_verify to function", E_USER_WARNING);
			return false;
		}
		$ret = crypt($password, $hash);
		if (!is_string($ret) || strlen($ret) != strlen($hash) || strlen($ret) <= 13) {
			return false;
		}

		$status = 0;
		for ($i = 0; $i < strlen($ret); $i++) {
			$status |= (ord($ret[$i]) ^ ord($hash[$i]));
		}

		return $status === 0;
	}

	/*
	 * Get information about the password hash. Returns an array of the information
	 * that was used to generate the password hash.
	 *
	 * array(
	 *    'algo' => 1,
	 *    'algoName' => 'bcrypt',
	 *    'options' => array(
	 *        'cost' => 10,
	 *    ),
	 * )
	 *
	 * @param string $hash The password hash to extract info from
	 *
	 * @return array The array of information about the hash.
	 */
	public static function get_info($hash) {
		$return = array(
			'algo' => 0,
			'algoName' => 'unknown',
			'options' => array(),
		);
		if (substr($hash, 0, 4) == '$2y$' && strlen($hash) == 60) {
			$return['algo'] = PASSWORD_BCRYPT;
			$return['algoName'] = 'bcrypt';
			list($cost) = sscanf($hash, "$2y$%d$");
			$return['options']['cost'] = $cost;
		}
		return $return;
	}

	/**
	 * Determine if the password hash needs to be rehashed according to the options provided
	 *
	 * If the answer is true, after validating the password using password_verify, rehash it.
	 *
	 * @param string $hash    The hash to test
	 * @param int    $algo    The algorithm used for new password hashes
	 * @param array  $options The options array passed to password_hash
	 *
	 * @return boolean True if the password needs to be rehashed.
	 */
	public static function needs_rehash($hash, $algo, array $options = array()) {
		$info = password_get_info($hash);
		if($info['algo'] != $algo) {
			return true;
		}
		switch ($algo) {
			case PASSWORD_BCRYPT:
				$cost = isset($options['cost']) ? $options['cost'] : 10;
				if ($cost != $info['options']['cost']) {
					return true;
				}
				break;
		}
		return false;
	}

}
