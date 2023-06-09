function Template(template, data) {
	this.data = data || {};
	// this.template = $(template).clone();	
	this.template = template;
	this.output = $(this.template).html();
};
Template.prototype.render = function( data ) {
	var values = data || this.data;
	this.output = $(this.template).clone();
	for (var key in values) {
	    if (values.hasOwnProperty(key)) {
	    	let value = values[key];
	    	// Allow Reactor objects to pass assignment
	    	if (
			    typeof value === 'object' &&
			    !Array.isArray(value) &&
			    value !== null &&
			    value.value !== undefined
			) {
	    		value = value.value;
			}
	    	this.re = "{{\\s?" + key + "\\s?}}"; // help from http://jsforallof.us/2014/12/01/the-anatomy-of-a-simple-templating-engine/
      		this.output.html(this.output.html().replace(new RegExp(this.re, "ig"), value));
	    }
	}
	return this.output.html();
};
Template.prototype.swap = function (element) {
	$(element).replaceWith(this.output.html());
};

export default Template;