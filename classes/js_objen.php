<?php
/**
 * JavaScript Object Generator
 *
 * Returns a <script>window.config =...</script> tag
 */
class Js_Objen {
	public static function generate($key_name, $config_array = array()) {
		//L o g::w($config_array, '$config_array');
		$json_config = json_encode($config_array);

		return
		"<script type='text/javascript'>//<![CDATA[
		window.{$key_name} = {$json_config};
		//]]></script> \n\t\t";
	}
}
