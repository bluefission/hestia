function Handheld() {
	PresentationModal.call(this, '#handheldModal', '.modal-body');
}
Handheld.prototype = PresentationModal.prototype;