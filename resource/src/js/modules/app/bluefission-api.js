import BlueFissionCrud from "./bluefission-crud.js"

var BlueFissionAPI = {
	user: new BlueFissionCrud('users'),
	admin_user: new BlueFissionCrud('admin/users'),
	addon: new BlueFissionCrud('admin/addons'),
	page: new BlueFissionCrud('admin/pages'),
	credential_status: new BlueFissionCrud('admin/credential_statuses'),
};

BlueFissionAPI.admin_user.credentials = function(data, callback) {
	this._transaction('admin/users/'+data.user_id+'/credentials', data, 'POST', callback);
};

BlueFissionAPI.user.information = function(userId, callback) {
	var data = {};
	this._transaction('users/'+userId+'/information', data, 'GET', callback);
};

BlueFissionAPI.addon.install = function(addon, callback) {
	this._transaction('admin/addons/install', addon, 'POST', callback);
};

BlueFissionAPI.addon.uninstall = function(addon, callback) {
	this._transaction('admin/addons/uninstall', addon, 'POST', callback);
};

BlueFissionAPI.addon.activate = function(addon, callback) {
	this._transaction('admin/addons/activate', addon, 'POST', callback);
};

export default BlueFissionAPI;