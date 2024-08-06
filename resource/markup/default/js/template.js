function Template(template, data) {
	this.data = data || {};
	// this.template = jQuery(template).clone();	
	this.template = template;
	this.output = jQuery(this.template).html();
};
Template.prototype.render = function( data ) {
	var values = data || this.data;
	this.output = jQuery(this.template).clone();
	for (var key in values) {
	    if (values.hasOwnProperty(key)) {
	    	this.re = "{{\\s?" + key + "\\s?}}"; // help from http://jsforallof.us/2014/12/01/the-anatomy-of-a-simple-templating-engine/
      		this.output.html(this.output.html().replace(new RegExp(this.re, "ig"), values[key]));
	    }
	}
	return this.output.html();
};
Template.prototype.swap = function (element) {
	jQuery(element).replaceWith(this.output.html());
};