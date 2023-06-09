import "../datatables";
import { Model, Reactor, ReactiveTemplate } from "../scripts/reactive_template.js";
import Template from "../scripts/template.js";
import PresentationModal from "../scripts/presentation-modal.js"

//== Class definition
var ModuleEntries = function() {
	var dataTable;
	const inputOptions = {
	  rejectOn: isNaN,
	  mutator: Number
	};

	const model = new Model;
	model.entry_id = new Reactor(0);
	model.name = new Reactor("");
	model.description = new Reactor("");
	model.status = new Reactor("");

	const settings = new Model;
	settings.settings_id = new Reactor(0);
	settings.entry_id = new Reactor(0);
	settings.value = new Reactor("");

	app.assign('entry_name', model.name);
	app.set('.entry-id-field', model.entry_id, 'value', inputOptions);
	app.set('.entry-name-field', model.name, 'value');
	app.set('.entry-description-field', model.description, 'value');
	app.set('.entry-status-field', model.status, 'value');

	// app.set('.settings-id', settings.settings_id, 'value', inputOptions);
	// app.set('.settings-entry-id', settings.entry_id, 'value', inputOptions);
	// app.set('.settings-value', settings.name, 'value');

	var ready = function() {
		$('#entry-edit-screen').hide();
		feather.replace();
	};
	
	var showEditScreen = function() {
		$('#entry-listing-screen').fadeOut(200, function(e) {
			$('#entry-edit-screen').fadeIn(200);
		});
	};

	var showListingScreen = function() {
		$('#entry-edit-screen').fadeOut(200, function(e) {
			$('#entry-listing-screen').fadeIn(200);
		});
	};

	var screenHome = function() {
		$('.home-btn').click(function(e) {
			showListingScreen();
		});
	};

	var loadEntryList = function() {
		dataTable = $('#dataTable').DataTable({
			ajax: {
				url: '/api/admin/entries',
				dataSrc: 'list'
			},
			aoColumnDefs: [
        { "bSortable": false, "aTargets": [ 3 ] }, 
        { "bSearchable": false, "aTargets": [ 2, 3 ] }
	    ],
			columns: [
				{
        	data: 'name',
					render: function(data, type, row) {
					  return `<a href="#" class="show-btn">${data}</a>`;
					},
				},
        { data: 'description' },
        { 
        	data: 'status',
        	render: function ( data, type, row ) {
				    return data == 1 ? `<span class="badge rounded-pill bg-success">Active</span>` : `<span class="badge rounded-pill bg-secondary">Inactive</span>`;
			  	}
        },
        {
				  data: null,
				  render: function ( data, type, row ) {
				    return '<button class="btn btn-sm btn-warning edit-btn"><i class="fa fa-pencil"></i></button> ' 
				    +'&nbsp;<button class="btn btn-sm btn-secondary settings-btn"><i class="fa fa-gear"></i></button>';
			  	}
				}
	   	]
		});
	};

	var entryShow = function() {
		$("#dataTable").on("click", ".show-btn", function(e) {
			e.preventDefault();
		// Get the row data (tr element) containing the clicked cell
		var data = dataTable.row( $(this).parents('tr') ).data();
		
			app.api.entry.read(data.entry_id, function(response) {
				model.update(response.data);
				// showEditScreen();
				const template = new Template('#entry-detail-display-item', model);
				template.render();
				template.swap('#entry-details');
	    });
		});
	};

	var entryNew = function() {
		$('#entry-add-btn').on('click', function(e) {
			e.preventDefault();
			model.clear();
			// $('#modalNewEntry').modal('show');
			showEditScreen();
    });
	};

	var entryDelete = function() {
		$('#entry-delete-btn').click(function() {
			app.api.entry.delete(model, function(response) {
				app.ui.notice("Entry has been deleted");
        dataTable.ajax.reload();
			});
		});
	};
	
	var entryEdit = function() {
		$('#dataTable').on('click', '.edit-btn', function(e) {
			e.preventDefault();
			let data = dataTable.row( $(this).parents('tr') ).data();
			let entry_id = data.entry_id;
			app.api.entry.read(entry_id, function(response) {
				model.update(response.data);
				$('#modalNewEntry').modal('show');
			});
    });
	};

	var entrySave = function() {
		$('.save-btn').click(function(e) {
			e.preventDefault();
			app.api.entry.save(model, function(response) {
				if (!response.id) {
					app.ui.notice(response.status, 'error');
					return;
				}
				model.clear();
        dataTable.ajax.reload();
        $('#modalNewEntry').modal('hide');
				app.ui.notice("Entry has been saved");
			});
		});

		$('#entry-save-btn').click(function(e) {
			e.preventDefault();
			app.api.entry.save(model, function(response) {
				if (!response.id) {
					app.ui.notice(response.status, 'error');
					return;
				}
				model.clear();
        dataTable.ajax.reload();
        showListingScreen();
				app.ui.notice("Entry has been saved");
			});
		});
	};

	var entryManage = function() {
		$('#dataTable').on('click', '.settings-btn', function(e) {
			e.preventDefault();
			let data = dataTable.row( $(this).parents('tr') ).data();
			let entry_id = data.entry_id;
			app.api.entry_settings.read(entry_id, function(response) {
				$('#modalEntrySettings').modal('show');
			});
    });
	};

	var entryConfigure = function() {
		$('#entry-settings-save-btn').click(function() {
			app.api.entry_settings.save(settings, function(response) {
        $('#modalNewEntry').modal('hide');
				app.ui.notice("Entry settings have been saved");
			});
		});
	};

	return {
        //main function to initiate the module
        init: function () {

        	screenHome();
        	loadEntryList();
        	entryShow();
        	entryNew();
        	entryEdit();
        	entryManage();
        	entryConfigure();
        	entrySave();

        	ready();
        }
    };
}();

jQuery(document).ready(function() {
    ModuleEntries.init();
});

export default ModuleEntries;