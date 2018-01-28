<?php
if(!defined('ROOT')) define('ROOT', realpath(dirname(dirname(__FILE__))) . '/');
$_SERVER['DOCUMENT_ROOT'] = ROOT;
$_SERVER['REQUEST_METHOD'] = 'CLI';

if(php_sapi_name() == 'cli') new Cli_Runner;
class Cli_Runner {

	public function __construct() {
		include ROOT . 'core/bootstrap.php';

		try { $this->_run_dynamic_command(); }
		catch (Exception $e) { new Custom_Exception($e); }
	}

	private function _run_dynamic_command() {

	}
}
