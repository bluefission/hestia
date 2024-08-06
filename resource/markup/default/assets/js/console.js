function Console() {
	PresentationModal.call(this, '#consoleModal', '.modal-body');
}
Console.prototype = PresentationModal.prototype;