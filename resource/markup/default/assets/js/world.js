function World() {
	PresentationBanner.call(this, '#environmentCarousel', '.active .carousel-caption');
}
World.prototype = PresentationBanner.prototype;