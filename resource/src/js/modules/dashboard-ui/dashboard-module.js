import RecordSe from "./record-set.js"
import DashboardUI from "./dashboard-ui.js"
import DashboardResponse from "./dashboard-response.js"

// Dashboard Module
// Requires JQuery, RecordSet, DashboardUI, DashboardResponse

/*
	functions: 
 */

// var DashboardModule = DashboardModule || {
function DashboardModule() {	
	this.title = 'New Module';
	this.name = 'module';
	this.parent = null;
	this.color = '#c0c0c0';
	this.type = 1;
	this.location = '';
	this.form = '';
	this.recordSet = {};
	this.index = 0;
	this.current = {};

	this.newBtn = '#new';
	this.saveBtn = '#save';
	this.deleteBtn = '#delete';

	this.entryList = '#list';

	this.entryModal = '#manage';
}

DashboardModule.prototype.init = function() {
	DashboardUI = DashboardUI || {};

	var module = this;
	jQuery('#new').click( function() {
		module.new();
	});
	jQuery('#save').click( function() {
		module.save();
	});
	jQuery('#delete').click( function() {
		var deletebutton = this;
		DashboardUI.confirm("Are you sure you want to delete this item?", function(result) {
        	if ( result ) {
				$form = $(deletebutton).closest('form');
				$form.find('input[name="action"]').val('delete');
		
				var id = $form.find('input[name="id"]').val();
				submitForm( $form );
				
				// If tabbed
				tab = $(deletebutton).closest('.tab-pane').attr('id');
				if ( tab )
					DashboardUI.removeTab(tab);
			}
        });
		module.view( module.current );
	});
	jQuery('#list a').on('click', function( e ) {
		e.preventDefault();
	
		module.current = $('[name="id"]').val();

		if ( module.current != $(this).attr('href') ) {
			module.current = $(this).attr('href');
			module.view();
		}
	});
	jQuery(document).on('unloadModules', this.unload);
}

DashboardModule.prototype.new = function() {
	DashboardForm.clear();
	
	DashboardUI.prompt("New Item", function(result) {
		if (result) {
			// Figure this out
		}
	});
}

DashboardModule.prototype.save = function() {
	var data = $form.serialize();
	var url = $form.attr('action');
	var method = $form.attr('method');

	var output = null;

	//console.log($form);

    $.ajax({
		url: url,
		data: data,
		method: method
	}).done(function( response ) {
		var reply = DashboardResponse.parse( response );

		DashboardUI.notice( reply.status )

		if ( callback )
			callback.call( $form, reply.data );
	}).fail(function( jqXHR, textStatus, errorThrown ) {
		console.log('============= AJAX ERROR =============');
		console.log(jqXHR);
		console.log(textStatus + " (" + jqXHR.status + ")");
		console.log(errorThrown);
		DashboardUI.notice( 'Leads: AJAX error saving entry. See console for details.' );
	});
}

DashboardModule.prototype.delete = function() {
	 
}

DashboardModule.prototype.view = function() {
	DashboardForm.updateID( this.current );
}

DashboardModule.prototype.autoSave = function () {
	DashboardUI.notice( 'Beginning Autosave' );
	if ( $(form).find('input[name="title"]').val() && activeCategory ) {
		var form = '.tab-pane.active form';
		var id = $(form).find('textarea').attr('id');

		var editor = CKEDITOR.instances[id];
		if (editor) { 
			$('#'+id).val( CKEDITOR.instances[id].getData( ) );
		}
		if ( !activeCategory ) {
			activeCategory = 'Personal';
			//addMenuItem( '#note-categories', activeCategory, activeCategory );
		}
	    var id = DashboardForm.submitForm( form, function( data ) {
			console.log('Autosave complete');
			DashboardUI.notice( 'Autosave Complete' );
		});
	}
}

DashboardModule.prototype.unload = function() {
	console.log(this.title + ' Unloading');
	jQuery('#new').off('click');
	jQuery('#save').off('click');
	jQuery('#delete').off('click');
	jQuery('#list a').off('click');
	jQuery(document).off('unloadModules', this.unload);
}

export default DashboardModule;