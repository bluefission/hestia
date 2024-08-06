function Typer (element, delay) {
	this.element = element;
	// this.content = content;
	this.delay = Number(delay) || 50;
};
Typer.prototype.render = function(content) {
	console.log(content);
	var typer = this;
	var ele = '<span>' + content.split('').join('</span><span>') + '</span>';

	$(ele).hide().appendTo(this.element).each(function (i) {
		// $(this).delay(this.delay * i).css({
		$(this).delay(50 * i).css({
			display: 'inline',
			opacity: 0,
		}).animate({
			opacity: 1,
		}, this.delay);
	});
	setTimeout(function() {
		typer.broadcast('typing.complete');
	}, this.delay*$(ele).length+200);
}
Typer.prototype.broadcast = function( eventName ) {
	$(this.element).trigger(eventName);
}