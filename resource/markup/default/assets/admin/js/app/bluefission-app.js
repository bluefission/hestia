var BlueFissionApp = {
	user: new BlueFissionCrud('users'),
	admin_user: new BlueFissionCrud('admin/users'),
	admin_initiative: new BlueFissionCrud('admin/initiatives'),
	admin_initiative_type: new BlueFissionCrud('admin/initiative_types'),
	admin_initiative_span: new BlueFissionCrud('admin/initiative_spans'),
	admin_initiative_status: new BlueFissionCrud('admin/initiative_statuses'),
	admin_initiative_privacy_type: new BlueFissionCrud('admin/initiative_privacy_types'),
	credential_status: new BlueFissionCrud('admin/credential_statuses'),

	admin_prerequisite: new BlueFissionCrud('admin/prerequisites'),
	admin_condition: new BlueFissionCrud('admin/conditions'),
	admin_reward: new BlueFissionCrud('admin/rewards'),

	admin_kpi_type: new BlueFissionCrud('admin/kpi_types'),
	admin_kpi_category: new BlueFissionCrud('admin/kpi_categories'),
	admin_attribute: new BlueFissionCrud('admin/attributes'),
	admin_operator: new BlueFissionCrud('admin/operators'),
	admin_unit_type: new BlueFissionCrud('admin/unit_types'),
};

BlueFissionApp.admin_user.credentials = function(data, callback) {
	this._transaction('admin/users/'+data.user_id+'/credentials', data, 'POST', callback);
};
BlueFissionApp.user.information = function(userId, callback) {
	var data = {};
	this._transaction('users/'+userId+'/information', data, 'GET', callback);
};
BlueFissionApp.admin_prerequisite.bulk_save = function(data, callback) {
	this._transaction('admin/prerequisites/bulk', data, 'POST', callback);
};
BlueFissionApp.admin_initiative.prerequisites = function(initiative_id, callback) {
	var data = {};
	this._transaction('admin/initiatives/'+initiative_id+'/prerequisites', data, 'GET', callback);
};
BlueFissionApp.admin_condition.bulk_save = function(data, callback) {
	this._transaction('admin/conditions/bulk', data, 'POST', callback);
};
BlueFissionApp.admin_initiative.conditions = function(initiative_id, callback) {
	var data = {};
	this._transaction('admin/initiatives/'+initiative_id+'/conditions', data, 'GET', callback);
};
BlueFissionApp.admin_initiative.kpi_types_save = function(data, callback) {
	this._transaction('admin/initiatives/kpi_types', data, 'POST', callback);
};
BlueFissionApp.admin_initiative.kpi_types = function(initiative_id, callback) {
	var data = {};
	this._transaction('admin/initiatives/'+initiative_id+'/kpi_types', data, 'GET', callback);
};