<?php

$GLOBALS['config'] = array(
	'environment' => 'local',
	'static_domain' => 'www.tipul.local',
	'static_base_domain' => 'tipul.local',
	'static_root' => 'G:/work/tipul/',
	'is_error_reporting_on' => false,
	'is_log_warnings' => false,

	'log_js' => true,
	'log_calls_to_db' => false,
	'log_db_results' => false,
	'is_logger_enabled' => true,
	'is_combine_enabled' => false,

	'DB' => array(
		'host' => 'localhost',
		'user' => 'ec2-user',
		'pass' => 'Cy@brief9',
		'name' => 'exam',
		'port' => '3306',
		'charset' => 'utf8'
	)
);
