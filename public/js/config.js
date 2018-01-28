(function(window) {
	if(!window.config) window.config = {};
	if(!window.template_options) window.template_options = {
		page_links: []
	};
	if(!window.user) window.user = {};
	window.config = {
		ip: (window.config.ip || 0),
		device: (window.config.device || ''),
		version: (window.config.version || 0),
		browser: (window.config.browser || ''),
		log_js: (window.config.log_js || true),
		platform: (window.config.platform || ''),
		base_url: (window.config.base_url || ''),
		is_local: (window.config.is_local || false),
		api_url: (window.config.api_url || ''),
		current_user_id: (window.config.current_user_id || 0),
		first_user_id: (window.config.first_user_id || 0),
		last_user_id: (window.config.last_user_id || 0),
		current_question_id: (window.config.current_question_id || 0),
		first_question_id: (window.config.first_question_id || 0),
		last_question_id: (window.config.last_question_id || 0)
	};
})(window);
