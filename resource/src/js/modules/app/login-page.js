//== Class definition
var LoginPage = function() {

	var login = function() {
		$('#login-btn').click(function() {
			var credentials = {};
			
			credentials.username = $('#inputUsername').val();
			credentials.password = $('#inputPassword').val();
			if ($('#inputRemember').is(':checked')) {
				credentials.remember = $('#inputRemember').val();
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
					location.reload();
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

export default LoginPage;