<?php
class Login_Page {
	public static $allowed_roles = array('anonymous');

	public function __construct() {
		$uri = $_SERVER['REDIRECT_URL'];
		$uri = explode('/',$uri);
		$problem = $uri[2];
		if($problem == 'problem'){
		$problem_text = '<p>פרטי התחברות אינם תקינים<br/>נסה/י שנית...</p>';
		Template::set('problem',$problem_text);
		}


		}
}
