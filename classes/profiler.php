<?php
/*
 *	Simple Profiler: log page load time and memory usage statistics
 *
 *	microtime(true) = current Unix timestamp with microseconds
 *	memory_get_peak_usage() = peak of memory in bytes
 */
class Profiler {
	public static $marks_array;

	// Profiler::set('Join');
	public static function set($mark) {
		if(!self::$marks_array) self::$marks_array = array();
		self::$marks_array[$mark . '_start_time'] = microtime(true);
		self::$marks_array[$mark . '_start_memory'] = memory_get_peak_usage();
	}

	// Profiler::get('Join');
	public static function get($mark) {
		$now_time = microtime(true);
		$total_time = ($now_time - self::$marks_array[$mark . '_start_time']);
		$total_time = round($total_time, 2) . 's';

		$now_memory = memory_get_peak_usage();
		$total_memory = ($now_memory - self::$marks_array[$mark . '_start_memory']);

		Log::write($mark . ' time: ' . $total_time . ' | Memory: ' . self::_format_bytes($total_memory) . ' | URL: "' . self::$marks_array['url'] . '"');
		return array('time' => $total_time, 'memory' => self::_format_bytes($total_memory));
	}

	public static function mark() {
		if(!empty(self::$marks_array)) return;

		self::$marks_array['url'] = $GLOBALS['config']['url']['full'];
		self::$marks_array['start_time'] = microtime(true);
		self::$marks_array['start_memory'] = memory_get_peak_usage();
	}

	private static function _format_bytes($bytes) {
		if($bytes >= 1000000000) $bytes = number_format($bytes / 1000000000, 2) . ' GB';
		else if($bytes >= 1000000) $bytes = number_format($bytes / 1000000, 2) . ' MB';
		else if($bytes >= 1000) $bytes = number_format($bytes / 1000, 2) . ' KB';
		else if($bytes > 1) $bytes = $bytes . ' bytes';
		else if($bytes == 1) $bytes = $bytes . ' byte';
		else $bytes = '0 bytes';

		return $bytes;
	}

	public static function show() {
		if(!Log::is_allowed_to_log()) return;

		self::set_totals();
		Log::details();
	}

	public static function set_totals() {
		$now_time = microtime(true);
		$total_time = ($now_time - self::$marks_array['start_time']);
		self::$marks_array['total_time'] = round($total_time, 2) . 's';

		$now_memory = memory_get_peak_usage();
		$total_memory = ($now_memory - self::$marks_array['start_memory']);
		self::$marks_array['total_memory'] = self::_format_bytes($total_memory);
	}
}

register_shutdown_function('Profiler::show');
