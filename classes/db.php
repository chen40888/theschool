<?php
/**
 * D.A.L. : Data Access Layer class that supports bound values using the ? syntax, transferring it as a simple ordered array "$params"
 * Simple static access, which returns either an array or a simple value
 */
class DB {
	private
		$sql,
		$result,
		$params,
		$start_time,
		$PDO_object,
		$PDO_connection;

	private static
		$inst;

	/**
	 * Setup a new DB query (a facade for "$PDO->prepare()")
	 *
	 * @param string $sql
	 * @param array $params
	 */
	private static function _prepare_and_execute($sql, $params) {
		try {
			if(empty($sql) || !is_string($sql)) throw new Custom_Exception(DB_Exception::$invalid_sql_must_be_a_valid_string);
			if(!self::$inst) self::_init_instance();

			self::$inst->sql = DB::trim_trailing_comma($sql);
			self::$inst->params = self::_get_normalized_params($params);
			self::$inst->start_time = microtime(true);
			self::$inst->result = '';

			self::_create_pdo_object();
			self::_run_exec();
		} catch(PDOException $e) {
			Log::write("DB ERROR | Query: <br>\n" . DB::sql_to_string() . "\n DB exception: " . $e->getMessage());
			new Custom_Exception(DB_Exception::$mysql_thrown_pdo_exception, $e->getMessage() . " |<br><br> Query: <br>\n" . DB::sql_to_string());
		}
	}

	private static function _get_normalized_params($params) {
		$is_associative_array = (array_keys($params) !== range(0, count($params) - 1));
		if(!$is_associative_array) return $params;
		return array_values($params);
	}

	private static function _init_instance() {
		self::$inst = new self;
		self::$inst->PDO_connection = new PDO('mysql:host=' . conf('DB.host') . '; dbname=' . conf('DB.name') . '; charset='.conf('DB.charset').';', conf('DB.user'), conf('DB.pass'), array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		));
	}

	private static function _create_pdo_object() {
		if(self::$inst->PDO_connection) self::$inst->PDO_object = self::$inst->PDO_connection->prepare(self::$inst->sql);
		if(!self::$inst->PDO_connection || !self::$inst->PDO_object) throw new Custom_Exception(DB_Exception::$failed_to_prepare_an_sql_statement);
	}

	private static function _run_exec() {
		//L o g::w(self::$inst->params);
		$is_success = self::$inst->PDO_object->execute(self::$inst->params);
		if(!$is_success) self::_handle_failed_execute();
	}

	private static function _handle_failed_execute() {
		$error_array = self::$inst->PDO_object->errorInfo();
		throw new Custom_Exception(DB_Exception::$invalid_pdo_response, $driver_specific_error_message = $error_array[2] . " |<br><br> Query: <br>\n" . DB::sql_to_string());
	}

	/**
	 * Get an indexed array of an array of rows, each row is an associative array of column_names => values
	 *
	 * @param string $sql
	 * @param array $params
	 * @return array result
	 */
	public static function fetch_all($sql, $params = array()) {
		self::_prepare_and_execute($sql, $params);
		self::$inst->result = self::$inst->PDO_object->fetchAll(PDO::FETCH_ASSOC);
		self::_run_profiler('DB=>fetch_all');
		return self::$inst->result;
	}

	/**
	 * Get a single simple associative array ("row") of values from the result of a given select
	 *
	 * @param string $sql
	 * @param array $params - optional
	 * @return array result
	 */
	public static function fetch_row($sql, $params = array()) {
		self::_prepare_and_execute($sql, $params);
		self::$inst->result = self::$inst->PDO_object->fetch(PDO::FETCH_ASSOC);
		self::_run_profiler('DB=>fetch_row');
		return self::$inst->result;
	}

	/**
	 * Get a simple list of values of the first column of the result as an indexed array
	 *
	 * @param string $sql
	 * @param array $params
	 * @param bool $is_fetch_field - log it as a 'fetch_field' request or a 'fetch_list' one
	 * @return array result
	 */
	public static function fetch_list($sql, $params = array(), $is_fetch_field = false) {
		self::_prepare_and_execute($sql, $params);
		self::$inst->result = self::$inst->PDO_object->fetchAll(PDO::FETCH_COLUMN);
		self::_run_profiler('DB=>fetch_' . ($is_fetch_field ? 'field' : 'list'));
		return self::$inst->result;
	}

	/**
	 * A 'fetch_list' facade, gets a single value from the result of a given select
	 *
	 * @param string $sql
	 * @param array $params - optional
	 * @return string self::$inst->result
	 */
	public static function fetch_value($sql, $params = array()) {
		$results = self::fetch_list($sql, $params, true);
		if(!isset($results[0])) return NULL;
		else return self::$inst->result = $results[0];
	}

	/**
	 * A simple 'exec facade' - for easier logging
	 *
	 * @param $profiler_sql_command - One of 'INSERT', 'UPDATE', 'REPLACE' or 'DELETE', for profiling only
	 * @param string $sql
	 * @param array $params
	 */
	public static function execute($profiler_sql_command, $sql, $params = array()) {
		self::_prepare_and_execute($sql, $params);
		self::_run_profiler('DB=>' . $profiler_sql_command);
	}

	/**
	 * Get the number of returned rows from the last Select (using SQL's "FOUND_ROWS()")
	 * @return int $number_of_results
	 */
	public static function count() {
		if(!self::$inst) self::_init_instance();
		$number_of_results = (int) self::$inst->PDO_connection->query('SELECT FOUND_ROWS()')->fetchColumn();
		//L o g::w($number_of_results, 'number_of_results');
		self::_run_profiler('DB=>count');
		return $number_of_results;
	}

	/**
	 * Get the id of the last inserted row
	 * @return int $last_inserted_id
	 */
	public static function last_insert_id() {
		if(!self::$inst) self::_init_instance();
		$last_insert_id = (int) self::$inst->PDO_connection->lastInsertId();
		//Log::w('$last_insert_id: ' . $last_insert_id);
		self::_run_profiler('DB=>last_insert_id');
		return $last_insert_id;
	}

	/**
	 * Get the number of rows effected by an update or insert
	 * @return int rowCount
	 */
	public static function affected() {
		if(!self::$inst) self::_init_instance();
		self::_run_profiler('DB=>affected');
		return self::$inst->PDO_object->rowCount();
	}

	/**
	 * Log the query and it's execution time
	 * @param string $from
	 */
	private static function _run_profiler($from) {
		$log_prefix = $from . ': ' . round((microtime(TRUE) - self::$inst->start_time), 4) . 's' . " | ";
		if(conf('log_calls_to_db')) Log::caller($log_prefix . "Query:\n" . self::sql_to_string());
		if(conf('log_db_results') && !empty(self::$inst->result)) Log::caller($log_prefix . "Results:  " . implode(', ', self::$inst->result));

		//Log::caller($from . ': ' . round((microtime(true) - self::$inst->start_time), 4) . 's' . ' | pathQuery: "' . preg_replace('/\r|\n/', '', substr(self::sql_to_string(self::$inst->sql), 0, 900)) . '"');
		//Log::caller('FULL Query: "' . self::sql_to_string(self::$inst->sql) . '"');
	}

	/**
	 * Trim removes all new lines, spaces, tabs etc. and the 'rtrim' removes the comma
	 * $string string
	 * @return string
	 * */
	public static function trim_trailing_comma($string) {
		return trim(rtrim($string), ',');
	}

	/**
	 * Get the raw query string of the last DB::query, replacing bound parameters (question marks) with real data
	 *
	 * http://stackoverflow.com/questions/530627/getting-a-pdo-query-string-with-bound-parameters-without-executing-it
	 * @return string
	 */
	public static function sql_to_string() {
		return preg_replace_callback('#\\?#', 'DB::parse_query_value_to_string', self::$inst->sql);
	}

	// ^Used by 'sql_to_string()' method
	public static function parse_query_value_to_string() {
		if(empty(self::$inst->params)) return '?';

		$value = array_shift(self::$inst->params);

		if($value === NULL) return 'NULL';
		if($value === true) return 'true';
		if($value === false) return 'false';
		if(is_numeric($value)) return $value;

		return "'" . $value . "'";
	}
}
