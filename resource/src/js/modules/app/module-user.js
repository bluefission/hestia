import "../datatables";
import { Model, Reactor, ReactiveTemplate } from "../scripts/reactive_template.js";
import Template from "../scripts/template.js";
import PresentationModal from "../scripts/presentation-modal.js"

//== Class definition
var ModuleUser = function() {
	var dataTable;
	const inputOptions = {
	  rejectOn: isNaN,
	  mutator: Number
	};
	
	const user = new Model;
	user.user_id = new Reactor(0);
	user.realname = new Reactor("");
	user.displayname = new Reactor("");
	user.email = new Reactor("");
	user.phone = new Reactor("");
	user.organization = new Reactor("");
	user.description = new Reactor("");
	user.status = new Reactor("");

	const total_users = new Reactor(0);
	const active_users = new Reactor(0);
	const user_churn = app.computed(() => ((total_users.value-active_users.value)/100)*100);

	app.assign('total_users', total_users);
	app.assign('active_users', active_users);
	app.assign('user_churn', user_churn);

	app.assign('user_realname', user.realname);
	app.set('#user-id', user.user_id, 'value', inputOptions);
	app.set('#user-realname', user.realname, 'value');
	app.set('#user-displayname', user.displayname, 'value');
	// app.set('#user-email', user.email);
	// app.set('#user-phone', user.phone);
	// app.set('#user-organization', user.organization);
	// app.set('#user-description', user.description);
	// app.set('#user-status', user.status);

	var loadUserStats = function() {
		total_users.value = 1;
		active_users.value = 1;
	};

	var loadUserList = function() {
		dataTable = $('#dataTable').DataTable({
			ajax: {
				url: '/api/admin/users',
				dataSrc: 'list'
			},
			aoColumnDefs: [
	        { "bSortable": false, "aTargets": [ 2 ] }, 
	        { "bSearchable": false, "aTargets": [ 2 ] }
		    ],
			columns: [
		        {
					data: 'realname',
							render: function(data, type, row) {
							  return `<a href="#" class="first-column-link">${data}</a>`;
							},
						},
		        { data: 'displayname' },
		        {
				  data: null,
				  render: function ( data, type, row ) {
				    return '<button class="btn btn-sm btn-warning edit-btn"><i class="fa fa-pencil"></i></button> ' 
				    +'&nbsp;<button class="btn btn-sm btn-secondary credential-edit-btn"><i class="fa fa-key"></i></button>';
				  }
				}
		    ]
		});
	};

	var userSelected = function(object) {
		var user_id = object.user_id;
		app.api.admin_user.read(user_id, function(response) {
			user.update(response.data);
			const template = new Template('#user-detail-display-item', user);
			template.render();
			template.swap('#user-details');
		});
	};
	
	var userEdit = function() {
		$('#dataTable').on('click', '.edit-btn', function(e) {
			e.preventDefault();
			var data = dataTable.row( $(this).parents('tr') ).data();
			// console.log(data);
			var user_id = data.user_id;
			app.api.admin_user.read(user_id, function(response) {
				// $('#user-id').val(response.data.user_id);
				// $('#user-realname').val(response.data.realname);
				// $('#user-displayname').val(response.data.displayname);

				$('#modalNewUser').modal('show');
			});
    });
	};

	var userSave = function() {
		$('#user-save-btn').click(function() {
			var user = {};
			user.user_id = $('#user-id').val();
			user.realname = $('#user-realname').val();
			user.displayname = $('#user-displayname').val();
			app.api.admin_user.save(user, function(response) {
        $('#modalNewUser').modal('hide');
				app.ui.notice("User has been saved");
        dataTable.ajax.reload();
			});
		});
	};

	var credentialEdit = function() {
		$('#dataTable').on('click', '.credential-edit-btn', function(e) {
			e.preventDefault();
			var data = dataTable.row( $(this).parents('tr') ).data();
			// console.log(data);
			var credential_id = data.credential_id;
			$('#credential-id').val(credential_id);
			$('#credential-password').val("");
			$('#credential-password-confirm').val("");
			
			$('#modalCredentials').modal('show');
    	});
	};

	var credentialSave = function() {
		$('#credential-save-btn').click(function() {
			var credential = {};
			credential.credential_id = $('#credential-id').val();
			credential.username = $('#credential-username').val();
			credential.password = $('#credential-password').val();
			credential.password_confirm = $('#credential-password-confirm').val();
			credential.credential_status_id = $('#credential-status-id').val();


			if (credential.password != credential.password_confirm) {
				app.ui.alert("Passwords do not match!");
				return;
			}
			app.api.admin_user.credentials(credential, function(response) {
        $('#modalCredentials').modal('hide');
				app.ui.notice("Credentials have been saved");
			});
		});
	};

	var loadCredentialStatusList = function() {
		app.api.credential_status.list(function(response) {
			var $list = $('#credential-status-id');
			var template = new Template('#credential-status-list-item');
			$list.find('option').remove();
			for ( var x = 0; x < response.list.length; x++ ) {
				console.log(response.list[x]);
				$list.append(template.render(response.list[x]));
			}
		});
	};

	var onFirstLoad = function() {
		var dialogue = new PresentationModal('#dialogueModal', '.dialogue-text');
		dialogue.open();
		dialogue.type("dialogue1", "Welcome to the User screen!");
	};

	return {
        //main function to initiate the module
		
        init: function () {

        	$("#dataTable").on("click", ".first-column-link", function() {
						// Get the row object (tr element) containing the clicked cell
						
						var data = dataTable.row( $(this).parents('tr') ).data();
						// Call the userSelected function with the row object
						userSelected(data);
					});
        	
        	// onFirstLoad();
        	loadUserList();
        	userEdit();
        	userSave();
        	credentialEdit();
        	credentialSave();
        	loadCredentialStatusList();
        	loadUserStats();

        	feather.replace();
        }
    };
}();
$(document).ready(function() {
    ModuleUser.init();
});

// export default ModuleUser;