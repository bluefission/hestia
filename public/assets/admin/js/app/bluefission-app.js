var BlueFissionApp = {
	user: new BlueFissionCrud('users'),
	admin_user: new BlueFissionCrud('admin/users'),
	credential_status: new BlueFissionCrud('admin/credential_statuses'),
};

BlueFissionApp.admin_user.credentials = function(data, callback) {
	// var data = {};
	this._transaction('admin/users/'+data.user_id+'/credentials', data, 'POST', callback);
};
BlueFissionApp.user.information = function(userId, callback) {
	var data = {};
	this._transaction('users/'+userId+'/information', data, 'GET', callback);
};