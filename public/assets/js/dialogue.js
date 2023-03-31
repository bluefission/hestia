function Dialogue() {
	PresentationModal.call(this, '#dialogueModal', '.dialogue-text');
}
Dialogue.prototype = PresentationModal.prototype;

Dialogue.prototype.title = function( name ) {
	$('#dialogueModalLabel .dialogue-title').text(name);
}