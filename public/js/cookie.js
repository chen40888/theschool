(function(window) {

	function bake(name, value, days) {
		var	now_plus_days = new Date().add_days(days || 14).toGMTString(),
			cross_sub_domains = window.location.host.toString().replace(/www|mobile(.*)/, '$1');

		window.document.cookie = [name, '=', String(value), ';expires=', now_plus_days, '; domain=', cross_sub_domains, '; path=/;'].join('');
		//log('days: ' + days + ' | now_plus_days: ' + now_plus_days + ' cross_sub_domains: ' + cross_sub_domains + ' | cookie: ' + document.cookie);
	}

	function read(key) {
		var i = 0,
			cookies = (window.document.cookie ? window.document.cookie.split('; ') : []),
			cookies_length = cookies.length,
			parts, name, cookie;

		for(i; i < cookies_length; i++) {
			parts = cookies[i].split('=');
			name = decodeURIComponent(parts.shift());
			cookie = parts.join('=');

			if(name == key) return _parse_value(cookie);
		}
		return undefined;
	}

	function _parse_value(cookie) {
		var pluses_regex = /\+/g;

		// Un-escape quoted cookie (according to RFC2068):
		if(cookie.indexOf('"') === 0) cookie = cookie.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');

		try {
			// Replace server-side written pluses with spaces | if unable to parse - ignore as unusable.
			cookie = decodeURIComponent(cookie.replace(pluses_regex, ' '));
			return cookie;
		} catch(e) {
			//log('_parse_value has failed to decodeURIComponent');
		}

		return null;
	}

	function remove(name) {
		if(is_defined(Cookie.read(name))) Cookie.bake(name, '', -1);
	}

	// *Used by Cookie.bake() | http://stackoverflow.com/questions/563406/add-days-to-datetime
	function _add_custom_method_add_days_to_date_prototype() {
		if(!('add_days' in Date.prototype)) Date.prototype.add_days = _add_days;

		function _add_days(days) {
			return new Date(this.getTime() + days * 86400000); // days in microseconds
		}
	}

	_add_custom_method_add_days_to_date_prototype();

	window.Cookie = {
		bake: bake,
		read: read,
		remove: remove
	}
})(window);
