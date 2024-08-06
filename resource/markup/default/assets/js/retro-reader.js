// Dashboard UI
// Requires jQuery, toastr and bootbox

var RetroReader = RetroReader || {
	command: 'pause',
	view: 'area',
	panel: '.page-content',
	logoutTimer: null,
	focused: true,
	
	init: function() {
		var reader = this;

		window.addEventListener('blur', function() {
		    reader.focused = false;
		});

		window.addEventListener('focus', function() {
		    reader.focused = true;
		});

		this.strap = new Strap();
		this.handheld = new Handheld();
		this.console = new Console();
		this.world = new World();
		this.area = new Area();
		this.dialogue = new Dialogue();
		this.chat = {};

		this.area.on('typing.complete', function() {
        	reader.followup();
        });
		this.area.on('close.complete', function() {
        	reader.followup();
        });
		this.dialogue.on('typing.complete', function() {
        	reader.followup();
        });
        this.dialogue.on('hidden.bs.modal', function() {
        	reader.followup();
        });
		this.console.on('typing.complete', function() {
        	reader.followup();
        });
        this.console.on('hidden.bs.modal', function() {
        	reader.followup();
        });
		// this.strap.on('typing.complete', function() {
  //       	reader.followup();
  //       });
        this.strap.on('hidden.bs.toast', function() {
        	reader.followup();
        });
		this.handheld.on('typing.complete', function() {
        	reader.followup();
        });
        this.handheld.on('hidden.bs.modal', function() {
        	reader.followup();
        });
        this.world.on('typing.complete', function() {
        	reader.followup();
        });
        this.world.on('close.complete', function() {
        	reader.followup();
        });
        this.world.on('fade.complete', function() {
        	reader.followup();
        });

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
	pause: function()
	{
		if ( this.view == 'area' ) {
			this.areaAppend('<button class="playBtn">Continue...</button>');
		}
		if ( this.view == 'dialogue' ) {
			this.dialogueAppend('<button class="playBtn">Continue...</button>');
		}
		if ( this.view == 'world' ) {
			this.worldAppend('<button class="playBtn">Continue...</button>');
		}
		if ( this.view == 'console' ) {
			this.consoleAppend('<button class="playBtn">Continue...</button>');
		}
		if ( this.view == 'handheld' ) {
			this.handheldAppend('<button class="playBtn">Continue...</button>');
		}
	},
	wait: function()
	{
		setTimeout(function() {
			$(document).trigger('reader.progress');
		}, 5000);
	},
	clearDialogs: function() {
		if ( typeof bootbox !== "undefined" ) {
			bootbox.hideAll();
		}
	},
	followup: function( ) {
		command = this.command;
		console.log(command);
		if ( typeof command === 'string' ) {
			switch(command) {
				case 'continue':
					$(document).trigger('reader.progress');
				break;
				default:
				case 'pause':
					this.pause();
				break;
				case 'wait':
					this.wait();
				break;
				case 'snd_play':
					this.wait();
					this.audioPlay();
				break;
				case 'bgm_play':
					this.wait();
					this.musicPlay();
				break;
				case 'bgm_pause':
					this.wait();
					this.musicPause();
				break;
			}
		}
	},
	strapAdd: function( content ) {
        this.strap.clear();
        this.strap.open();
        this.strap.type(content);
	},
	areaAppend: function( content ) {
        this.area.add(content);
	},
	areaAdd: function( content ) {
        this.area.type('areaContent'+index, content);
	},
	areaNew: function( content ) {
		var reader = this;
        this.area.clear();
        this.area.open();
        this.area.type('areaContent'+index, content, 50)
	},
	areaClose: function() {
		this.area.close();
	},
	dialogueAppend: function( content ) {
        this.dialogue.open();
        this.dialogue.add(content);
	},
	dialogueAdd: function( content, style, motion ) {
        this.dialogue.style = style;

        this.dialogue.effect(motion);
        this.dialogue.type('dialogueContent'+index, content);
	},
	dialogueNew: function( content, style, motion, source ) {
		var reader = this;
        this.dialogue.clear();
		var photo = '';
		if ( source.image !== undefined && source.image != '' && source.image != null ) {
			photo = '<div style="width:30%;display:inline-block;">'+
                        '<div class="mmry-ln">'+
                            '<div class="grid">'+
                                '<div class="grid__item">'+
                                    '<div class="glitch glitch--style-1">'+
                                        '<div class="glitch__img"></div>'+
                                        '<div class="glitch__img"></div>'+
                                        '<div class="glitch__img"></div>'+
                                        '<div class="glitch__img"></div>'+
                                        '<div class="glitch__img"></div>'+
                                    '</div>'+
                                    '<h2 class="grid__item-title">'+source.title+'<span class="glitch-in">//'+source.job+'</span></h2>'+
                                '</div>'+
                            '</div>'+
                        '</div>';//+
                    // '</div>';

            photo += '<style style="display:none !important;">'+
            	'.glitch__img {'+
				'background-image: url(assets/images/faces/'+source.image+');'+
				'}'+
				'</style>'+
               '</div>';
            // this.dialogue.add(photo);
            $('.dialogue-photo').empty();
            $(photo).hide().appendTo('.dialogue-photo').fadeIn();
            $('.dialogue-photo').fadeIn();
            $('.dialogue-text').removeClass('col-md-12').addClass('col-md-8');
		} else {
			$('.dialogue-photo').hide();
            $('.dialogue-text').removeClass('col-md-8').addClass('col-md-12');
		}
        this.dialogue.open();

        this.dialogue.effect(motion);
		this.dialogue.title(source.name)
        this.dialogue.style = style;
        this.dialogue.type('dialogueContent'+index, content, 50)
	},
	dialogueClose: function() {
		this.dialogue.close();
	},
	strapAppend: function( content ) {
        this.strap.open();
        this.strap.add(content);
	},
	strapAdd: function( content, style ) {
        this.strap.open();
        this.strap.style = style;
        this.strap.type(content);
	},
	strapNew: function( content, style ) {
		var reader = this;
        this.strap.clear();
        this.strap.open();
        $('#audioPlayer').trigger("pause");
		$('#audioPlayer').trigger("load");
		$('#audioPlayer .mp3src').attr('src', 'assets/audio/Cell-phone-notification-1.mp3');
        $('#audioPlayer').trigger("play");
        this.strap.style = style;
        this.strap.type(content, 50);
	},
	worldAdd: function( content ) {
        this.world.type('worldContent'+index, content);
	},
	worldNew: function( content ) {
		var reader = this;
        this.world.clear();
        this.world.open();
        this.world.type('worldContent'+index, content, 50);
        
	},
	worldAppend: function( content ) {
        this.world.open();
        this.world.add(content);
	},
	worldAdvance: function( content ) {
        this.world.open();
        this.world.next();
	},
	worldReverse: function( content ) {
        this.world.open();
        this.world.prev();
	},
	handheldAppend: function( content ) {
        this.handheld.open();
        this.handheld.add(content);
	},
	handheldAdd: function( content ) {
        this.handheld.clear();
        this.handheld.open();
        this.handheld.type('handheldContent'+index, content);
	},
	handheldNew: function( content, style ) {
		var reader = this;
        this.handheld.clear();
        this.handheld.open();
        this.handheld.type('handheldContent'+index, content, 50)
	},
	handheldClose: function() {
		this.handheld.close();
	},
	consoleAppend: function( content ) {
        this.console.open();
        this.console.add(content);
	},
	consoleAdd: function( content ) {
        this.console.clear();
        this.console.open();
        this.console.type('consoleContent'+index, content);
	},
	consoleNew: function( content, style ) {
		var reader = this;
        this.console.clear();
        this.console.open();
        this.console.type('consoleContent'+index, content, 50)
	},
	consoleClose: function() {
		this.console.close();
	},
	worldAdd: function( content ) {
        this.world.clear();
        this.world.open();
        this.world.type(content);
	},
	worldClose: function() {
		this.world.close();
	},
	media: function (data) {
		if (data.audio !== undefined) {
			$('#audioPlayer').trigger("pause");
			$('#audioPlayer').trigger("load");
			$('#audioPlayer .mp3src').attr('src', 'assets/audio/'+data.audio);
		}
		if (data.music !== undefined) {
			$('#musicPlayer').trigger("pause");
			$('#musicPlayer').trigger("load");
			$('#musicPlayer .mp3src').attr('src', 'assets/audio/'+data.music);
		}
	},
	process: function(data) {
		console.log(data);
		this.command = data.followup;
		this.view = data.display;
		var source = data.source || { name: '???', image: null };
		var motion = data.motion || '';
		var media = data.media || {};

		this.media(media);
		if (data.display == 'area')
		{
			if (data.method == 'new') {
				this.areaNew(data.content);
			}
			if (data.method == 'add') {
				this.areaAdd(data.content);
			}
			if (data.method == 'close') {
				this.areaClose();
			}
		}

		if (data.display == 'world')
		{
			if (data.method == 'new') {
				this.worldNew(data.content);
			}
			if (data.method == 'add') {
				this.worldAdd(data.content);
			}
			if (data.method == 'close') {
				this.worldClose();
			}
			if (data.method == 'advance') {
				this.worldAdvance();
			}
			if (data.method == 'reverse') {
				this.worldReverse();
			}
		}

		if (data.display == 'strap')
		{
			if (data.method == 'new') {
				this.strapNew(data.content);
			}
			if (data.method == 'add') {
				this.strapAdd(data.content);
			}
		}
		
		if (data.display == 'dialogue')
		{
			if (data.method == 'new') {
				this.dialogueNew(data.content, data.style, data.motion, source);
			}
			if (data.method == 'add') {
				this.dialogueAdd(data.content, data.style, data.motion);
			}
			if (data.method == 'append') {
				this.dialogueAppend(data.content);
			}
			if (data.method == 'close') {
				this.dialogueClose();
			}
		}
		
		if (data.display == 'handheld')
		{
			if (data.method == 'new') {
				this.handheldNew(data.content, data.style);
			}
			if (data.method == 'add') {
				this.handheldAdd(data.content, data.style);
			}
			if (data.method == 'append') {
				this.handheldAppend(data.content);
			}
			if (data.method == 'close') {
				this.handheldClose();
			}
		}
				
		if (data.display == 'console')
		{
			if (data.method == 'new') {
				this.consoleNew(data.content, data.style);
			}
			if (data.method == 'add') {
				this.consoleAdd(data.content, data.style);
			}
			if (data.method == 'append') {
				this.consoleAppend(data.content);
			}
			if (data.method == 'close') {
				this.consoleClose();
			}
		}

		index++;
	}, 
	audioPlay: function() {
		$('#audioPlayer').trigger("play");
		// $(document).trigger('reader.progress');
	}, 
	musicPlay: function() {
		$('#musicPlayer').trigger("play");
		// $(document).trigger('reader.progress');
	}, 
	musicPause: function() {
		$('#musicPlayer').trigger("pause");
		// $(document).trigger('reader.progress');
	}
};