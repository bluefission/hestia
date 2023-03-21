//== Class definition
var ModuleUser = function() {
	var dataTable;
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
		        { data: 'realname' },
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
	
	var userEdit = function() {
		$('#dataTable').on('click', '.edit-btn', function(e) {
			e.preventDefault();
			var data = dataTable.row( $(this).parents('tr') ).data();
			// console.log(data);
			var user_id = data.user_id;
			BlueFissionApp.admin_user.read(user_id, function(response) {
				$('#user-id').val(response.data.user_id);
				$('#user-realname').val(response.data.realname);
				$('#user-displayname').val(response.data.displayname);

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
			BlueFissionApp.admin_user.save(user, function(response) {
        		$('#modalNewUser').modal('hide');
				toastr.success("User has been saved");
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
				DashboardUI.alert("Passwords do not match!");
				return;
			}
			BlueFissionApp.admin_user.credentials(credential, function(response) {
        		$('#modalCredentials').modal('hide');
				toastr.success("Credentials have been saved");
			});
		});
	};

	var loadCredentialStatusList = function() {
		BlueFissionApp.credential_status.list(function(response) {
			var $list = $('#credential-status-id');
			var template = new Template('#credential-status-list-item');
			$list.find('option').remove();
			for ( var x = 0; x < response.list.length; x++ ) {
				console.log(response.list[x]);
				$list.append(template.render(response.list[x]));
			}
		});
	};

	return {
        //main function to initiate the module
        init: function () {
        	
        	loadUserList();
        	userEdit();
        	userSave();
        	credentialEdit();
        	credentialSave();
        	loadCredentialStatusList();
        }
    };
}();

jQuery(document).ready(function() {
    ModuleUser.init();
});