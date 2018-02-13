<?php
new Action_Page;
class Action_Page {

	public function __construct() {
		if(isset($_POST['insert_course'])) {
			include ROOT . 'classes/upload.php';
			$cours_name = $_POST['course_name'];
			$description = $_POST['description'];
			$file_name = $_FILES["file"]["name"];

			Action_Table::insert_course($cours_name,$description,$file_name);
			header("Location: inside");
//			new Home_Page;
		}


	}

}
