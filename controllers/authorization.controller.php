<?php
/**
 * Authorization_Controller:
 *
 * Validate the token exists in the DB.
 * If older than 5 hours -> create a new token
 * If older than 2 days -> logout the user. If page request -> redirect, if Ajax request - throw redirect exception.
 * (JS on client, will check all responses for redirect execption, and will redirect the user as the server ordered)
 *
 * Verify that the user is authorized to DO the requested action
 *
 * Ex.: Can a Student-user access the Exam Page?
 * Ex.: Can an Anonymous-user run the delete_option command?
 */
class Authorization_Controller {
	public static function authorize($user_role, $file_name, $file_type) {
		//Log::w('$file_name: ' . $file_name . ' | $file_type: ' . $file_type . ' | $user_role: ' . $user_role);
		if(empty($file_name) || empty($file_type)) return true;
		if(!is_class_exists($file_name, $file_type)) return false;

		$class_name = Request::$command_name;
		//L o g::w('$user_role: ' . $user_role . ' | $file_name: ' . $file_name . ' | $file_type: ' . $file_type . ' | $class_name: ' . $class_name);
		//L o g::w($class_name::$allowed_roles, '$allowed_roles');

		if(!class_exists($class_name) || !isset($class_name::$allowed_roles) || !property_exists($class_name, 'allowed_roles')) {
			//Log::w('class_name:' . $class_name . ' | allowed_roles:' . $class_name::$allowed_roles);
			return false;
		}

		return (in_array($user_role, $class_name::$allowed_roles));
	}
}
