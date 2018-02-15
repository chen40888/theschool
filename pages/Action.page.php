<?php
new Action_Page;
class Action_Page {

	public function __construct() {
		if(isset($_POST['insert_course'])) {
			$this->add_course();
		}

		if(isset($_POST['login'])) {
			$this->login_valid();
		}

	}

	function add_course() {
		include ROOT . 'classes/upload.php';
		$cours_name = $_POST['course_name'];
		$description = $_POST['description'];
		$file_name = $_FILES["file"]["name"];

		Action_Table::insert_course($cours_name,$description,$file_name);
		//Response::die_with_redirect('inside', 'from the Action page');
	}

	function login_valid() {
		$mail_or_id = $_POST['mail_or_id'];
		$pass = $_POST['pass'];
		$user = Action_Table::login_valid($mail_or_id,$pass);
		$user_id = $user['id'];
		Cookie::bake('user_id', $user_id);

//		echo User::$id;

		if($user === FALSE) {
//			var_dump($user);

//			header("Location: login");
			echo '<a href="login/problem"><button>login</button></a>';
		}
//		header("Location: inside");

	}


}
