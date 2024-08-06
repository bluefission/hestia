function PresentationModal (container, body) {
	
	this.container = container;
	this.body = body;
	this.style = '';
	$(this.container).modal({backdrop: 'static', keyboard: false});
};

PresentationModal.prototype.open = function() {
	$(this.container).modal('show');
};
PresentationModal.prototype.close = function() {
	$(this.container).modal('hide');
	$(this.container).trigger('display.close');
};
PresentationModal.prototype.clear = function() {
	$(this.container + ' ' + this.body).children().fadeOut(function() {
		$(this).remove();
	});
};
PresentationModal.prototype.add = function( element ) {
	$(element).hide().appendTo(this.container + ' ' + this.body).fadeIn(1000);
};
PresentationModal.prototype.type = function( element, content, delay ) {
	this.add('<div id="'+element+'" class="'+this.style+'">');
	var typer = new Typer('#'+element, delay);
	typer.render(content);
};
PresentationModal.prototype.on = function( eventName, callback ) {
	$(this.container).on(eventName, callback);
};
PresentationModal.prototype.effect = function( motion ) {
	var style = "";

	switch( motion ) {
		case 'shake':
			style = 'animate__animated animate__shakeX animate__repeat-2';
		break;
		case 'yes':
			style = 'animate__animated animate__shakeY';
		break;
		case 'no':
			style = 'animate__animated animate__headShake';
		break;
		case 'pulse':
			style = 'animate__animated animate__pulse';
		break;
		case 'heart':
			style = 'animate__animated animate__heartBeat';
		break;
		case 'drop':
			style = 'animate__animated animate__bounce';
		break;
	}
	$(this.container).addClass(style).delay(4000).queue(function(next){
	    $(this).removeClass(style);
	    next();
	});
}