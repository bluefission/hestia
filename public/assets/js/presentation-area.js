function PresentationArea (container, body) {
	
	this.container = container;
	this.body = body;
};

PresentationArea.prototype.open = function() {
	$(this.container).slideDown();
};
PresentationArea.prototype.close = function() {
	$(this.container).slideUp('slow', function() {
		$(this).trigger('close.complete');
	});
};
PresentationArea.prototype.clear = function() {
	$(this.container + ' ' + this.body).children().addClass('delete');
	$(this.container + ' ' + this.body + ' span').each(function (i) {
		// $(this).delay(this.delay * i).css({
		$(this).delay(Math.floor(Math.random() * 10) * i).css({
			opacity: 1,
			position: 'relative',
		}).animate({
			opacity: 0,
			top: '80px',
		}, 150);
	});
	$(this.container + ' ' + this.body + ' div').delay(1000).slideUp(1000).fadeOut(1000, function() {
		$(this).parent().find('.delete').fadeOut(function() {
			$(this).remove();
		});
	});
	$(this.container).trigger('clear.complete');
};
PresentationArea.prototype.add = function( element ) {
	$(element).hide().appendTo(this.container + ' ' + this.body).fadeIn(1000);
};
PresentationArea.prototype.type = function( element, content, delay ) {
	this.add('<div id="'+element+'">');
	var typer = new Typer('#'+element, delay);
	typer.render(content);
};
PresentationArea.prototype.on = function( eventName, callback ) {
	$(this.container).on(eventName, callback);
};