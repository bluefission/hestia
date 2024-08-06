//== Class definition
var LoginPage = function() {

	var login = function() {
		$('#login-btn').click(function(e) {
			e.preventDefault();
			var credentials = {};
			
			credentials.username = $('#loginUsername').val();
			credentials.password = $('#loginPassword').val();
			if ($('#loginRemember').is(':checked')) {
				credentials.remember = $('#loginRemember').val();
			}

			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

			var payload = {
				method: 'POST',
				url: '/login',
				data: credentials,
				cache: false
			};

			$.ajax(payload).done(function( response ) {
				if ( response.status ) {
					alert(response.status);
				}
				if (response.data == 'true') {
					location = '/dashboard';
				}
			}).fail(function( jqXHR, textStatus, errorThrown ) {

			});
		});
	};

	return {
        //main function to initiate the module
        init: function () {
        	login();
        }
    };
}();

jQuery(document).ready(function() {
    LoginPage.init();
});