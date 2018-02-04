<?php
class Home_Page {
	public static $allowed_roles = array('anonymous');

	public function __construct() {
		Template::set('content', 'עובד, יופי טופי');
	}
}
