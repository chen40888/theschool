<?php
// Depends on environment.php and helpers.php
// http://stackoverflow.com/questions/3724584/what-is-the-best-way-to-save-config-variables-in-a-php-web-app
if(!defined('ROOT')) define('ROOT', realpath(dirname(dirname(__FILE__))) . '/'); // Only this works 100% from CRON and allows PHPStorm to auto detect paths
if(!isset($_SERVER['HTTP_HOST'])) $_SERVER['HTTP_HOST'] = conf('static_domain');

$sub_domain = substr(serv('HTTP_HOST'), 0, strpos(serv('HTTP_HOST'), '.'));
if(!preg_match('/www|mobile/', $sub_domain)) {
	$sub_domain = 'www';  // Support cron/cli + no "www"
	set_conf('is_valid_sub_domain', false);
} else {
	set_conf('is_valid_sub_domain', true);
}
$domain = conf('static_domain');

set_conf(array(
	'version' => '0.1',
	'sub_domain' => $sub_domain,
	'domain' => conf('static_domain'),
	'base_static_url' => 'http://' . conf('static_domain') . '/',
	'uri' => trim(serv('REQUEST_URI', '')),
	'query' => trim(serv('QUERY_STRING', '')),
	'URL' => 'http://' . $domain . '/',
	'host' => trim(serv('HTTP_HOST', $domain)),
	'SecureURL' => 'https://' . $domain . '/',
	'port' => serv('SERVER_PORT', 80)
));

set_conf(array(
	'base_url' => (conf('port') == 80 ? conf('URL') : conf('SecureURL')),
	'base_http' => 'http' . (conf('port') == 80 ? '' : 's') . '://'
));

set_conf(array(
	'url' => array(
		'api' => conf('base_url') . 'api/',
		'public' => conf('base_url') . 'public/',
		'css' => conf('base_url') . 'public/css/',
		'js' => conf('base_url') . 'public/js/',
		'images' => conf('base_url') . 'public/images/',
		'full' => conf('base_http') . conf('host') . conf('uri') . conf('query'),
		'courses' => conf('base_url') . 'public/images/courses/',
		'users' => conf('base_url') . 'public/images/users/',
		'students' => conf('base_url') . 'public/images/students/'
	),

	'path' => array(
		'public' => ROOT . 'public/',
		'public_css' => ROOT . 'public/css/',
		'js' => ROOT . 'public/js/',
		'css' => ROOT . 'public/css/',
		'lib_js' => ROOT . 'app/js/dev/',
		'page' => ROOT . 'views/',
		'partial' => ROOT . 'partials/',
		'courses' => ROOT . 'public/images/courses/',
		'users' => ROOT . 'public/images/users/',
		'students' => ROOT . 'public/images/students/'
	),

	'date' => array(
		'php' => 'Y-m-d',
		'base' => '%d/%m/%Y',
		'full' => 'Y-m-d H:i:s',
		'long' => '%d/%m/%Y %H:%i',
		'last_modified' => 'D, d M Y H:i:s'
	),
	'login_salt' => '`5l(<  j||Rq7S)Co~tpe[+0re8/O+#&blZ<q=CB$UwK5&p4U %{B6/.[>a&X){B',
	'token_characters' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
));

if(conf('is_error_reporting_on')) error_reporting(-1); // report all
else error_reporting(0); // disable reporting
