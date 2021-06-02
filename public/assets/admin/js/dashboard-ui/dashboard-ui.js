// Dashboard UI
// Requires jQuery, toastr and bootbox

var DashboardUI = DashboardUI || {
	panel: '.page-content',
	logoutTimer: null,
	focused: true,
	root: '/',
	home: 'dashboard/',
	moduleDir: 'modules/',
	menuClass: '.page-sidebar',
	subMenuClass: 'sub-menu',
	menuItemActiveClass: 'active',
	menuItemClass: 'ul li a',
	
	init: function() {
		var dash = this;

		toastr.options = {
			"closeButton": false,
			"debug": false,
			"newestOnTop": false,
			"progressBar": false,
			"positionClass": "toast-top-right",
			"preventDuplicates": false,
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}

		window.addEventListener('blur', function() {
		    dash.focused = false;
		});

		window.addEventListener('focus', function() {
		    dash.focused = true;
		});

		// Form controls
		$('form.async').on(document, 'submit', function( e ) {
			e.preventDefault();
			var id = DashboardForm.submitForm( this, function( data ) {
				$(this).find('input[name="list_id"]').val( data );
			});
		});

		$(this.menuClass+" "+this.menuItemClass).click( this.menuClick );

		this.goHome();

		this.logoutInterval();
	},
	// Dialog methods
	alert: function( msg, callback ) {
		if ( typeof bootbox !== "undefined" ) {
			bootbox.alert( msg, callback );
		} else {
			alert( msg );
			callback.call();
		}
	},
	confirm: function( msg, callback ) {
		if ( typeof bootbox !== "undefined" ) {
			bootbox.confirm( msg, callback );
		} else {
			var result = confirm( msg );
			
			if ( result != false ) {
				callback.call( result );
			}
		}
	},
	prompt: function ( msg, callback ) {
		if ( typeof bootbox !== "undefined" ) {
			bootbox.prompt( msg, callback );
		} else {
			var result = prompt( msg );

			if ( result != null ) {
			    callback.call( result );
			}
		}
	},
	dialog: function ( msg, type ) {
		if ( typeof bootbox !== "undefined" ) {
			bootbox.dialog(msg);
		} else {
			console.log( msg );
			window.status = msg;
		}
	},
	notice: function ( msg, type ) {
		if ( typeof toastr !== "undefined" ) {
			type = type ? type : 'success';
			toastr[type]( msg );
		} else if( $('.header .'+type).length ) {


			$('.header .'+type).text(msg).fadeIn(100).delay(5000).fadeOut(400);
			$('html, body').animate({
			    scrollTop: 0
			}, 500);

		} else {
			console.log( msg );
			window.status = msg;
		}
	},
	clearDialogs: function() {
		if ( typeof bootbox !== "undefined" ) {
			bootbox.hideAll();
		}
	},
	//Tabdrop Functions
	clearTabs: function ( tabdrop ) {
		var dash = this;
		var $group = $(tabdrop +' .tab-pane');
		var first = $group.first().attr('id');

		$(tabdrop +' .tab-pane').each( function() {
			var id = $(this).attr('id');
			if ( id != first ) {
				dash.removeTab(id);
			}
		});
	},
	addTab: function ( tabdrop, name, id ) {
		$(tabdrop +' .nav-tabs li').removeClass('active');
		$(tabdrop +' .tab-content div').removeClass('active');

		var $newtab = $(tabdrop +' .nav-tabs li').last().clone();
		var $newpane = $(tabdrop +' .tab-content div').first().clone();

		$newtab.addClass('active');
		$newpane.addClass('active');

		//Customize this tab
		$newtab.find('a').html( name ).attr('href', '#'+id);

		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			var target = $(e.target).attr("href");
			$(target).find('input[type="text"],textarea')[0].focus();
		});

		//Customize this pane
		$newpane.attr('id', id);

		$newpane.find('.cke').remove();

		//Add new content	
		$(tabdrop +' .nav-tabs').append($newtab);
		$(tabdrop +' .tab-content').append($newpane);
				
		return $newpane;
	},
	addMenuItem: function( menugroup, name, href ) {
		var $newmenu = $(menugroup +' li:first-child').clone();

		//Customize this tab
		$newmenu.find('a').html( name ).attr('href', href);

		//Add new content
		var $anchor = $(menugroup).find('.divider');

		if ( $anchor.length )
			$(menugroup).find('.divider').first().before($newmenu);
		else
			$(menugroup).append($newmenu);
		
		return $newmenu;
	},
	removeTab: function( id ) {
		var $tab = $('.nav-tabs a[href="#'+id+'"]').parent();
		this.removeArea($tab);
		this.removeArea('#'+id);
	},
	removeArea: function( selector ) {	
		this.removeRTEs(selector);
		$(selector).fadeOut( 200, function() {
			$(this).remove();
		});
	},
	// Navigation
	redirect: function( url ) {
		var url = $('.link').val();
		var prot = url.substring(0,4);
		var path = url.substring(0,2);
		if (prot != 'http' && path != './')
			url = './'+url;
		window.location.href = url;
		// window.open(url);
		return false;
	},
	navigate: function( page )
	{

		/*
		// TODO: Itererate through forms for unsave dialogs
		if ( this.checkObjectUnchanged() )
		{
			
		}
		*/
		if (page != 'expand')
		{
			var dash = DashboardUI || this;
			var destination = ( (window.location.hash) ? window.location.hash.substr(2):dash.home );
			var $menuitem = $(this.menuClass + ' a[href="'+destination+'"]');
			var file = this.moduleDir + ( page ? page : destination );
			if ( this.panel.length < 1 ) { // TODO: check is module exists
				this.redirect(page);
				return false;
			}

			if ( $menuitem.is(':visible'))
			{
				$(dash.menuClass).find('.'+dash.menuItemActiveClass).removeClass(dash.menuItemActiveClass).removeClass('start').removeClass('open').find('.arrow').removeClass('open');
				
				if ( $menuitem.parent().parent().hasClass(dash.subMenuClass) ) {
					$menuitem.parent().addClass(dash.menuItemActiveClass).parent().addClass(dash.menuItemActiveClass);
				} else {
					$menuitem.parent().addClass(dash.menuItemActiveClass).find('.arrow').addClass('open');
				}

			}

			$(this.panel).fadeTo(100, .33, function() 
			{
			 	$(dash.panel).load(file, function() 
				 {
					 $(dash.panel).fadeTo(100, 1 );
				 });
			} );
			
			if ( page ) {
				window.location = window.location.href.replace(window.location.hash, '')+'#/'+page;
				$('html, body').animate({
				    scrollTop: 0
				}, 500);
			}	
		}
	},
	//Load initial content
	goHome: function() {
		this.navigate();
	},
	menuClick: function( e ) {
		e.preventDefault();

		var dash = DashboardUI || this;
		/*
		TODO implement login
		if (!$.cookie('user_id'))
		{
			window.location = window.location.href.replace(window.location.hash, '');
			return false;
		}
		*/
		if ($(this).hasClass('module'))
		{
			dash.navigate( $(this).attr("href") );

			if ( $(this).parent().parent().hasClass(dash.subMenuClass) )
			{
				$(this).parent().parent().parent().addClass('clicked').parent().find('.'+dash.menuItemActiveClass).removeClass(dash.menuItemActiveClass).parent().find('.clicked').removeClass('clicked').addClass(dash.menuItemActiveClass);
				$(this).parent().addClass(dash.menuItemActiveClass);
			}
			else if ( $(this).parent().find('.'+dash.subMenuClass).length > 0 )
			{
				// Do nothing
			}
			else
			{
				var $last_button = $(this).parent().addClass('clicked').parent().find('.'+dash.menuItemActiveClass);
				if ($last_button.length > 0) {
					$last_button.removeClass(dash.menuItemActiveClass).parent().find('.clicked').removeClass('clicked').addClass(dash.menuItemActiveClass);
				} else {
					$(this).parent().removeClass('clicked').addClass(dash.menuItemActiveClass);
				}
			}
		}
		else if ( $(this).parent().find('.'+dash.subMenuClass).length > 0 )
		{
			// Do nothing
		}
		else
		{
			$(this).parent().addClass('clicked').parent().find('.'+dash.menuItemActiveClass).removeClass(dash.menuItemActiveClass).parent().find('.clicked').removeClass('clicked').addClass(dash.menuItemActiveClass);

			window.open( $(this).attr("href"));
		}
	},
	//TODO implement
	openLink: function()
	{
		var url = $('.link').val();
		var prot = url.substring(0,4);
		if (prot != 'http')
		url = 'http://'+url;
		window.open(url);
		return false;
	},
	removeRTEs: function( selector ) {
		var editor = $(selector).find('textarea').attr('id');
		if (CKEDITOR.instances[editor]) {
			var ckedit = CKEDITOR.instances[editor]
			if ( typeof(ckedit) != 'undefined' && ckedit!=null ) {
				ckedit.removeAllListeners();
				ckedit.destroy(true);
				CKEDITOR.remove(ckedit);
				//ckedit = null;
				//CKEDITOR.instances[editor] = null;
			}
		}
	},
	logoutInterval: function() {
		this.logoutTimer = setInterval( (function(self) { 
			//Self-executing func which takes 'this' as self
			return function() {   //Return a function in the context of 'self'
				self.warnLogout(); //Thing you wanted to run as non-window 'this'
			}
		})(this),(60*60*1000) - (60*1*1000));
	},
	resetInterval: function() {
		var dash = DashboardUI;
		clearInterval(this.logoutTimer);

		$.ajax({
			url: this.root,
			data: {'login': true},
			method: 'POST'
		}).done(function( response ) {
			var reply = DashboardResponse.parse( response );
			if ( reply.data == false ) {
				dash.autoLogout();
				return;
			}

			DashboardUI.notice( reply.status );
			dash.logoutInterval();
		});
		/*
		this.logoutTimer = setInterval( (function(self) { 
			//Self-executing func which takes 'this' as self
			return function() {   //Return a function in the context of 'self'
				self.warnLogout(); //Thing you wanted to run as non-window 'this'
			}
		})(this),(60*60*1000) - (60*5*1000));
		*/
	},
	warnLogout: function() {
		clearInterval(this.logoutTimer);
		this.logoutTimer=setInterval( (function(self) { 
			//Self-executing func which takes 'this' as self
			return function() {   //Return a function in the context of 'self'
				self.autoLogout(); //Thing you wanted to run as non-window 'this'
			}
		})(this),60*1*1000);
		this.confirm("Do you want to stay logged in?", this.resetInterval);
	},
	autoLogout: function() {
		if ( this.focused ) {
			// window.location = window.location.href.replace(window.location.hash, '')+'?logout=true';
			$('logout-form').submit();
		}
	}
};