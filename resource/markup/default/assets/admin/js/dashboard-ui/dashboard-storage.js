// Dashboard Storage 

var DashboardStorage = DashboardStorage || {
	id: 'storage', // why id a singleton?!
	data: [],
	storage: localStorage,
	set: function( key, value ) {
		this.data[key] = value;
	},
	get: function( key ) {
		if ( key in this.data ) {
			return this.data[key];
		}
	},
	clear: function () {
		this.data = [];
	},
	save: function() {
		var info = JSON.stringify(this.data)
		storage.setItem( this.id, info );
		// addItem( this.id, JSON.stringify(this.data) );
	},
	load: function() {
		var info = storage.getItem( this.id );
		this.data = JSON.parse( info );
	},
	remove: function() {
		// addItem( this.id, null );
		storage.removeItem( this.id );
	},
	setCookie: function(cname, cvalue, exdays) {
	    var d = new Date();
	    d.setTime(d.getTime() + (exdays*24*60*60*1000));
	    var expires = "expires="+ d.toUTCString();
	    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	},
	getCookie: function(cname) {
	    var name = cname + "=";
	    var decodedCookie = decodeURIComponent(document.cookie);
	    var ca = decodedCookie.split(';');
	    for(var i = 0; i <ca.length; i++) {
	        var c = ca[i];
	        while (c.charAt(0) == ' ') {
	            c = c.substring(1);
	        }
	        if (c.indexOf(name) == 0) {
	            return c.substring(name.length, c.length);
	        }
	    }
	    return "";
	}
};