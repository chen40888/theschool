(function(window) {
	/**
	 * Provided an object and a string representing a nested property, isset returns true when all parts are set
	 *
	 * http://stackoverflow.com/questions/4343028/in-javascript-test-for-property-deeply-nested-in-object-graph
	 * @param {object} object
	 * @param {string} nested_property_string
	 * @returns {boolean}
	 */
	function isset(object, nested_property_string) {
		var parts = (typeof nested_property_string == 'string' && nested_property_string.split('.')),
			current = object;

		if(!parts) return false;
		for(var i = 0; i < parts.length; i++) {
			if(!current || !current[parts[i]]) {
				return false;
			}
			current = current[parts[i]];
		}
		return true;
	}

	function is_defined(value) {
		return (typeof value != 'undefined');
	}

	window.isset = isset;
	window.is_defined = is_defined;

})(window);



