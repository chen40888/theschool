<?php
class Page_Controller {
	private
		$page_name,
		$template_params;

	public function __construct($template_params = array()) {
//		Request::$command_name = str_replace('Command', 'Page', Request::$command_name);

		$this->_set_page_name();
		$this->_set_template_params($template_params);
		$this->_authorize_page_request();
		$this->_die_with_page();
	}

	private function _set_page_name() {
		$this->page_name = Request::get('arg0', 'login');
	}

	private function _set_template_params($template_params) {
		Template::set($template_params);
		$this->template_params = $template_params;
	}

	private function _authorize_page_request() {
		//Log::w('$role: ' . User::$role);
		if(!Authorization_Controller::authorize(User::$role, $this->page_name, 'page')) {
			Response::die_with_redirect((User::$id ? 'school' : 'login'), 'Page_Controller->not_authorized');
		}
	}

	private function _die_with_page() {
		new Request::$command_name;
		$content = Template::get_page($this->page_name, $this->template_params, true);
		$header = $this->_get_page_header_html();
		$footer = $this->_get_page_footer_html();

		Response::die_with_html($header . $content . $footer);
	}

	private function _get_page_header_html() {
		return Template::get_partial('header', array(
			'avatar' => conf('url.users') . User::$image,
			'page_name' => $this->page_name,
			'title' => ucwords(str_replace('_', ' ', $this->page_name)),
			'css_tags_html' => $this->_get_html_tags_by_type('css')
		));
	}

	private function _get_page_footer_html() {
		return Template::get_partial('footer', array(
			'client_config' => Js_Objen::generate('config', $this->_get_base_client_config_array()),
			'template_options' => Js_Objen::generate('template_options', Template::$template_options),
			'user' => Js_Objen::generate('user', get_class_vars('User')),
			'js_tags_html' => $this->_get_html_tags_by_type('js')
		));
	}

	private function _get_html_tags_by_type($type) {
		$tags_array = Config::get('base_resources.' . $type);
		$tag_per_page = (file_exists(conf('path.' . $type) . $this->page_name . '.' . $type) ? array($this->page_name) : array());
		$tags_array = array_merge($tags_array, $tag_per_page);
		$tags_array = $this->_merge_by_rules($tags_array, $this->_get_additional_tags_array($type));

		return HTML::get_js_or_css_tags($tags_array, ($type == 'js'));
	}

	private function _get_additional_tags_array($type) {
		if(empty(Template::$template_options['additional_' . $type . '_array']['files_to_insert'])) return array();

		$files_to_insert = Template::$template_options['additional_' . $type . '_array']['files_to_insert'];
		foreach($files_to_insert as $key => $file_name) {
			if(!file_exists(conf('path.' . $type) . $file_name . '.' . $type)) unset(Template::$template_options['additional_' . $type . '_array']['files_to_insert'][$key]);
		}

		return (!empty(Template::$template_options['additional_' . $type . '_array']) ? Template::$template_options['additional_' . $type . '_array'] : array());
	}

	// Expected array structure for rules_array: array('rule' => 'after', 'file_pointer' => 'fonts', 'files_to_insert' => array('momo', 'shushu'));
	private function _merge_by_rules($tags_array, $rules_array) {
		if(empty($rules_array['files_to_insert'])) return $tags_array;
		if(empty($rules_array['rule']) || ($rules_array['rule'] != 'before' && $rules_array['rule'] != 'after')) return array_merge($tags_array, $rules_array['files_to_insert']);

		$position = array_search($rules_array['file_pointer'], $tags_array);
		$new_options = $tags_array;

		if($rules_array['rule'] == 'after') $position++;
		foreach($rules_array['files_to_insert'] as $file) {
			array_splice($new_options, $position, 0, $file);
			$position++;
		}

		//Log::w($rules_array['files_to_insert'], '$rule: ' . $rules_array['rule'] . ' | $file_pointer: ' . $rules_array['file_pointer'] . ' | $position: ' . $position . ' | $files_to_insert');
		return $new_options;
	}

	private function _get_base_client_config_array() {
		return array_merge(array(
			'log_js' => conf('log_js'),
			'ip' => serv('REMOTE_ADDR'),
			'version' => conf('version'),
			'api_url' => conf('url.api'),
			'base_url' => conf('base_url'),
			'is_local' => (conf('environment') == 'loc'),
			'base_static_url' => conf('base_static_url'),
			'is_dev' => (conf('environment') != 'production')
		), (array) Detect::get_base_data());
	}
}
