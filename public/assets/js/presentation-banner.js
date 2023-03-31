function PresentationBanner (container, body) {
	
	this.container = container;
	this.body = body;
	$(this.container).carousel({interval: false, keyboard: false});

	$(this.container).on('slid.bs.carousel', function() {
		$(this).trigger('fade.complete');
	});
};

PresentationBanner.prototype.open = function() {
	$(this.container).slideDown();
};
PresentationBanner.prototype.close = function() {
	$(this.container).slideUp('slow', function() {
		$(this).trigger('close.complete');
	});
};
PresentationBanner.prototype.clear = function() {
	$(this.container + ' ' + this.body).empty();
};
PresentationBanner.prototype.add = function( element ) {
	$(element).hide().appendTo(this.container + ' ' + this.body).fadeIn(1000);
};
PresentationBanner.prototype.type = function( element, content, delay ) {
	this.add('<div id="'+element+'">');
	var typer = new Typer('#'+element, delay);
	typer.render(content);
};
PresentationBanner.prototype.on = function( eventName, callback ) {
	$(this.container).on(eventName, callback);
};
PresentationBanner.prototype.next = function() {
	$(this.container).carousel('next');
};
PresentationBanner.prototype.prev = function() {
	$(this.container).carousel('previous');
};