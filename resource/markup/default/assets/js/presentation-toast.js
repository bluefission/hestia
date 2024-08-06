function PresentationToast (container, body) {
	
	this.container = container;
	this.body = body;
	$(this.container).toast();
};

PresentationToast.prototype.open = function() {
	$(this.container).toast('show');
};
PresentationToast.prototype.close = function() {
	$(this.container).toast('hide');
	$(this.container).trigger('display.close');
};
PresentationToast.prototype.clear = function() {
	$(this.container + ' ' + this.body).empty();
};
PresentationToast.prototype.add = function( element ) {
	$(element).appendTo(this.container + ' ' + this.body);
};
PresentationToast.prototype.type = function( content ) {
	this.add('<div class="typed-out '+this.style+'">'+content+'</div>');
	// var typer = new Typer('#'+element, delay);
	// typer.render(content);
};
PresentationToast.prototype.on = function( eventName, callback ) {
	$(this.container).on(eventName, callback);
};