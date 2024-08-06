var RetroApp = {
	user: new BlueFissionCrud('users'),
	chat: new BlueFissionCrud('chat'),
};

RetroApp.user.initiatives = function(callback) {
	data = {};
	this._transaction('users/'+user_id+'/initiatives', data, 'GET', callback);
};
RetroApp.user.initiative = function(initiative_id, callback) {
	data = {};
	this._transaction('users/'+user_id+'/initiative/'+initiative_id, data, 'GET', callback);
};
RetroApp.user.initiative_accept = function(initiative_id, callback) {
	data = {'initiative_id': initiative_id};
	this._transaction('users/'+user_id+'/initiatives', data, 'POST', callback);
};

RetroApp.chat.send = function(text, callback) {
	data = {
		"driver": "web",
		"userId": "1234",
		"message": "text"
	};
	this._transaction('chat', data, 'POST', callback);
};