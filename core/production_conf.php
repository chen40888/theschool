<?php

$GLOBALS['config'] = array(
	'environment' => 'production',
	'static_domain' => 'www.alongoldberg.com',
	'static_base_domain' => 'alongoldberg.com',
	'static_root' => '/var/www/html/',
	'is_error_reporting_on' => false,
	'is_log_warnings' => false,

	'log_js' => true,
	'log_calls_to_db' => false,
	'log_db_results' => false,
	'is_logger_enabled' => true,
	'is_combine_enabled' => true,

	'DB' => array(
		'host' => 'localhost',
		'user' => 'ec2-user',
		'pass' => 'Cylon@amaz',
		'name' => 'exam',
		'port' => '3306',
		'charset' => 'utf8'
	)
);
