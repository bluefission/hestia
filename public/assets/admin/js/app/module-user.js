//== Class definition
var ModuleUser = function() {
	var dataTable;
	var loadUserList = function() {
		// BlueFissionApp.admin_user.list(function(response) {
			// var $list = $('#user-list');
			// var template = new Template('#user-list-item');

			// $list.find("tr").remove();
			// for ( var x = 0; x < response.list.length; x++ ) {
			// 	$list.append(template.render(response.list[x]));
			// }
			
		// });
		dataTable = $('#dataTable').DataTable({
			ajax: {
				url: '/api/admin/users',
				dataSrc: 'list'
			},
			aoColumnDefs: [
		        { "bSortable": false, "aTargets": [ 3 ] }, 
		        { "bSearchable": false, "aTargets": [ 3 ] }
		    ],
			columns: [
		        { data: 'realname' },
		        { data: 'username' },
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
				$('#user-username').val(response.data.username);
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
        		dataTable.ajax().reload();
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

	var sceneAdd = function() {
		$('.scene-add-btn').click(function(e) {
			e.preventDefault();
			$('#scene-new-form').trigger("reset");
			currentChapter = $(this).attr('rel');
			$('#scene-chapter').val(currentChapter);
			$('#modalNewScene').modal('show');
			console.log('current chapter: '+ currentChapter);
       		loadSceneList({chapter_id: currentChapter});
    	});
	};

	var onChapterSelectChange = function() {
		$('#scene-chapter').change(function() {
			var chapterId = $(this).val();
       		loadSceneList({chapter_id: chapterId}, false);
		});
	};

	var updateSceneSelect = function(data) {
		KubrickApp.scene.find(data, function(response) {
			toastr.success("Scenes have been loaded");
		});
	};

	var sceneDelete = function() {
		$('#scene-list .scene-item .controls .delete').click(function(e) {
			e.preventDefault();
			var scene = $(this).attr('rel');
			var doDelete = confirm("Are you sure you want to delete this scene?");
			if (doDelete == true) {
				KubrickApp.scene.remove(scene, function(response) {
					toastr.success("Scene has been deleted");
					$('.scene-item[rel='+scene+']').fadeOut();
				});
			} else {
				return false;
			}
		});
	};

	var chapterAdd = function() {
		$('#chapter-add-btn').click(function(e) {
			$('#chapter-new-form').trigger("reset");
			$('#modalNewChapter').modal('show');
    	});
	};

	var chapterSave = function() {
		$('#chapter-save-btn').click(function() {
			var chapter = {};
			chapter.film_id = $('#film-edit-form input[name="id"]').val();
			chapter.name = $('#chapter-name').val();
			chapter.id = $('#chapter-id').val();
			chapter.ordinance = $('#chapter-ordinance').val();
			chapter.description = $('#chapter-description').val();
			KubrickApp.chapter.save(chapter, function(response) {
        		$('#modalNewChapter').modal('hide');
				toastr.success("Chapter has been saved");

        		loadChapterList();
        		loadSceneList({chapter_id: currentChapter});
			});
		});
	};

	var directorSave = function() {
		$('#director-save-btn').click(function() {
			var director = {};
			director.first_name = $('#director-first-name').val();
			director.last_name = $('#director-last-name').val();
			director.description = $('#director-description').val();
			KubrickApp.director.save(director, function(response) {
        		$('#modalNewDirector').modal('hide');
				toastr.success("Director has been saved");

        		loadDirectorList();
			});
		});
	};

	var loadDirectorList = function() {
		KubrickApp.director.list(function(response) {
			var $select = $('#filmDirector');
			$select.find("option:gt(1)").remove();
			for ( var x = 0; x < response.length; x++ ) {
				$select.append('<option value="'+response[x].id+'">'+response[x].last_name+ ', ' +response[x].first_name+'</option>');
			}
        	loadFilm();
		});
	}

	var loadChapterList = function() {
		var data = {film_id: $('#film-edit-form input[name="id"]').val()};
		KubrickApp.chapter.find(data, function(response) {
			var $list = $('#chapter-list');
			for ( var x = 0; x < response.length; x++ ) {
				$list.append('<li><a href="/admin/chapter/'+response[x].id+'" rel="'+response[x].id+'">'+response[x].name+'</a></li>');
			}
			var $select = $('#chapter-ordinance');
			$select.find("option:gt(0)").remove();
			for ( var x = 0; x < response.length; x++ ) {
				$select.append('<option value="'+(x+1)+'">After '+response[x].name+ '</option>');
			}

			$select = $('#scene-chapter');
			$select.find("option").remove();
			for ( var x = 0; x < response.length; x++ ) {
				$select.append('<option value="'+response[x].id+'">'+response[x].name+ '</option>');
			}
		});
	}

	var loadFilm = function() {
		var id = $('#film-edit-form input[name="id"]').val();
		KubrickApp.film.read(id, function(response) {
			$('#filmInputName').val(response.name);
			$('#filmDirector').val(response.director_id);
			$('#filmInputYear').val(response.year);
			$('#filmDescription').val(response.description);
		});
	}

	var filmSave = function() {
		$('#film-save-btn').click(function(e) {
			e.preventDefault();
			var film = {};
			film.id = $('#film-edit-form input[name="id"]').val();
			film.director_id = $('#filmDirector').val();
			film.name = $('#filmInputName').val();
			film.year = $('#filmInputYear').val();
			film.description = $('#filmDescription').val();
			KubrickApp.film.save(film, function(response) {
				$('#film-new-form').trigger("reset");
				toastr.success("Film has been saved");
			});
		});
	}

	var characterAdd = function() {
		$('#character-add-btn').click(function(e) {
			$('#character-new-form').trigger("reset");
			$('#character-new-form input[type=hidden]').val("");
			$('#modalNewCharacter').modal('show');
    	});
	};

	var characterView = function() {
		$('#character-view-btn').click(function() {
			var id = $(this).attr('rel');
			window.location = '/admin/films/'+filmId+'/characters/'+id;
		});
	};

	var characterEdit = function() {
		$('#character-list').on('click', 'a', function(e) {
			e.preventDefault();
			var id = $(this).attr('rel');
			KubrickApp.character.read(id, function(response) {
				$('#character-view-btn').attr('rel', response.id);
				
				$('#character-id').val(response.id);
				$('#character-name').val(response.name);
				$('#character-ordinance').val(response.ordinance);
				$('#character-code').val(response.code);
				if (response.image) {
					$('#character-image-view').show();
					$('#character-image-view').attr('src', cdnUrl+response.image);
				} else {
					$('#character-image-view').hide();
				}
				$('#character-description').val(response.description);
				$('#modalNewCharacter').modal('show');
			});
    	});
	};

	var characterSave = function() {
		$('#character-save-btn').click(function() {
			var character = {};
			var character = new FormData($("#character-new-form")[0]);
			// var character = new FormData();

			character.append("film_id", $('#film-edit-form input[name="id"]').val());
			character.append("id", $('#character-id').val());
			character.append("name", $('#character-name').val());
			character.append("code", $('#character-code').val());
			character.append("description", $('#character-description').val());

			// character.film_id = $('#film-edit-form input[name="id"]').val();
			// character.id = $('#character-id').val();
			// character.name = $('#character-name').val();
			// character.code = $('#character-code').val();
			// character.description = $('#character-description').val();
			// character.scene_image_file = $('#related-scene-image-file').get()[0].files[0];
			// character.related_scene_image_file = $('#related-scene-image-file').get()[0].files[0];
			
			/*
			if ( formData.get("image_name") != "" ) {
				formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
			    formData.append("media_id", data.id);
				$.ajax({
			        url: '/api/scenes/'+sceneId+'/assets',
			        type: 'POST',
			        data: formData,
			        success: function(result)
			        {
			            // location.reload();
			            toastr.info("File Uploaded");
			        },
			        error: function(data)
			        {
			            console.log(data);
			        }
			    });
			}
			*/

			KubrickApp.character.save(character, function(response) {
        		$('#modalNewCharacter').modal('hide');
				toastr.success("Character has been saved");

        		loadCharacterList();
			});
		});
	};

	var loadCharacterList = function() {
		var data = {film_id: $('#film-edit-form input[name="id"]').val()};
		KubrickApp.character.find(data, function(response) {
			var $list = $('#character-list');
			var template = new Template('#character-list-item');
			$list.find("li").remove();
			for ( var x = 0; x < response.length; x++ ) {
				// $list.append('<li><a href="#" rel="'+response[x].id+'">'+response[x].code+' - '+response[x].name+'</a></li>');
				$list.append(template.render(response[x]));
			}
		});
	}

	var settingAdd = function() {
		$('#setting-add-btn').click(function(e) {
			$('#setting-new-form').trigger("reset");
			$('#modalNewSetting').modal('show');
    	});
	};

	var settingEdit = function() {
		$('#setting-list').on('click', 'a', function(e) {
			e.preventDefault();
			var id = $(this).attr('rel');
			KubrickApp.setting.read(id, function(response) {
				$('#setting-view-btn').attr('rel', response.id);
				
				$('#setting-id').val(response.id);
				$('#setting-name').val(response.name);
				$('#setting-venue').val(response.venue);
				$('#setting-code').val(response.code);
				$('#setting-image').val("");
				$('#setting-description').val(response.description);
				$('#modalNewSetting').modal('show');
			});
    	});
	};

	var settingView = function() {
		$('#setting-view-btn').click(function() {
			var id = $(this).attr('rel');
			window.location = '/admin/films/'+filmId+'/settings/'+id;
		});
	};

	var settingSave = function() {
		$('#setting-save-btn').click(function() {
			var setting = {};
			setting.film_id = $('#film-edit-form input[name="id"]').val();
			setting.id = $('#setting-id').val();
			setting.venue = $('#setting-venue').val();
			setting.name = $('#setting-name').val();
			setting.code = $('#setting-code').val();
			setting.description = $('#setting-description').val();
			KubrickApp.setting.save(setting, function(response) {
        		$('#modalNewSetting').modal('hide');
				toastr.success("Setting has been saved");

        		loadSettingList();
			});
		});
	};

	var loadSettingList = function() {
		var data = {film_id: $('#film-edit-form input[name="id"]').val()};
		KubrickApp.setting.find(data, function(response) {
			var $list = $('#setting-list');
			var template = new Template('#setting-list-item');
			$list.find("li").remove();
			for ( var x = 0; x < response.length; x++ ) {
				// $list.append('<li><a href="#" rel="'+response[x].id+'">'+response[x].code+' - '+response[x].name+' ('+response[x].venue+')</a></li>');
				$list.append(template.render(response[x]));
			}
		});
	}

	var venueView = function() {
		$('#venue-view-btn').click(function() {
			var id = $(this).attr('rel');
			window.location = '/admin/films/'+filmId+'/venues/'+id;
		});
	};

	var venueAdd = function() {
		$('#setting-venue').change(function(e) {
    		selected = $(this).find(':selected')[0];
    		console.log( $(selected) );
    		if ( $(selected).attr('id') == 'add-new-venue' ) {
				$('#venue-new-form').trigger("reset");
    			$('#modalNewVenue').modal('show');
    		}
    	});
	}

	var venueSave = function() {
		$('#venue-save-btn').click(function() {
			var venue = {};
			venue.film_id = $('#film-edit-form input[name="id"]').val();
			venue.name = $('#venue-name').val();
			venue.description = $('#venue-description').val();
			KubrickApp.venue.save(venue, function(response) {
        		$('#modalNewVenue').modal('hide');
				toastr.success("Venue has been saved");

        		loadVenueList();
			});
		});
	};

	var loadVenueList = function() {
		var data = {film_id: $('#film-edit-form input[name="id"]').val()};
		KubrickApp.venue.find(data, function(response) {
			var $select = $('#setting-venue');
			$select.find("option:gt(1)").remove();
			for ( var x = 0; x < response.length; x++ ) {
				$select.append('<option value="'+response[x].id+'">'+response[x].name+ '</option>');
			}
		});
	}

	var themeAdd = function() {
		$('#theme-add-btn').click(function(e) {
			$('#theme-new-form').trigger("reset");
			$('#modalNewTheme').modal('show');
    	});
	};

	var themeEdit = function() {
		$('#theme-list').on('click', 'a', function(e) {
			e.preventDefault();
			var id = $(this).attr('rel');
			KubrickApp.theme.read(id, function(response) {
				$('#theme-view-btn').attr('rel', response.id);

				$('#theme-id').val(response.id);
				$('#theme-name').val(response.name);
				$('#theme-parent').val(response.parent_id);
				$('#theme-code').val(response.code);
				if (response.image) {
					$('#theme-image-view').show();
					$('#theme-image-view').attr('src', cdnUrl+response.image);
				} else {
					$('#theme-image-view').hide();
				}
				$('#theme-description').val(response.description);
				$('#modalNewTheme').modal('show');
			});
    	});
	};

	var themeView = function() {
		$('#theme-view-btn').click(function() {
			var id = $(this).attr('rel');
			window.location = '/admin/films/'+filmId+'/themes/'+id;
		});
	};

	var themeSave = function() {
		$('#theme-save-btn').click(function() {
			var theme = {};
			var theme = new FormData($("#theme-new-form")[0]);
			// var theme = new FormData();

			theme.append("film_id", $('#film-edit-form input[name="id"]').val());
			theme.append("id", $('#theme-id').val());
			theme.append("name", $('#theme-name').val());
			theme.append("code", $('#theme-code').val());
			theme.append("description", $('#theme-description').val());

			// var theme = {};
			// theme.film_id = $('#film-edit-form input[name="id"]').val();
			// theme.parent_id = $('#theme-parent').val();
			// theme.id = $('#theme-id').val();
			// theme.name = $('#theme-name').val();
			// theme.code = $('#theme-code').val();
			// theme.description = $('#theme-description').val();
			
			KubrickApp.theme.save(theme, function(response) {
        		$('#modalNewTheme').modal('hide');
				toastr.success("Theme has been saved");

        		loadThemeList();
			});
		});
	};

	var loadThemeList = function() {
		var data = {film_id: $('#film-edit-form input[name="id"]').val(), parent_id: null};
		KubrickApp.theme.find(data, function(response) {
			var $list = $('#theme-list');
			var $select = $('#theme-parent');

			var template = new Template('#theme-list-item');
			var template2 = new Template('#theme-select-item');

			$list.find("li").remove();
			$select.find('option:gt(0)').remove();
			var $parents = {};

			for ( var x = 0; x < response.length; x++ ) {
				response[x].code = response[x].code || "00";
				$select.append(template2.render(response[x]));
				var $li = $(template.render(response[x]));
				$parents[response[x].id] = $li;
				var data = {film_id: $('#film-edit-form input[name="id"]').val(), parent_id: response[x].id};
				KubrickApp.theme.find(data, function(response2) {
					var $ul = $('<ul>');
					for ( var y = 0; y < response2.length; y++ ) {
						$ul.append(template.render(response2[y]));
					}
					if (response2.length > 0) {
						console.log(y-1);
						$parents[response2[y-1].parent_id].append($ul);
					}
				});
				$list.append($li);
			}
		});
	}

	var narrativeAdd = function() {
		$('#narrative-add-btn').click(function(e) {
			$('#narrative-new-form').trigger("reset");
			$('#modalNewNarrative').modal('show');
    	});
	};

	var narrativeEdit = function() {
		$('#narrative-list').on('click', 'a', function(e) {
			e.preventDefault();
			var id = $(this).attr('rel');
			KubrickApp.narrative.read(id, function(response) {
				$('#narrative-view-btn').attr('rel', response.id);

				$('#narrative-id').val(response.id);
				$('#narrative-name').val(response.name);
				$('#narrative-venue').val(response.venue);
				$('#narrative-code').val(response.code);
				$('#narrative-image').val("");
				$('#narrative-description').val(response.description);
				$('#modalNewNarrative').modal('show');
			});
    	});
	};

	var narrativeView = function() {
		$('#narrative-view-btn').click(function() {
			var id = $(this).attr('rel');
			window.location = '/admin/films/'+filmId+'/narratives/'+id;
		});
	};

	var narrativeSave = function() {
		$('#narrative-save-btn').click(function() {
			var narrative = {};
			narrative.film_id = $('#film-edit-form input[name="id"]').val();
			narrative.id = $('#narrative-id').val();
			narrative.venue = $('#narrative-venue').val();
			narrative.name = $('#narrative-name').val();
			narrative.code = $('#narrative-code').val();
			narrative.description = $('#narrative-description').val();
			KubrickApp.narrative.save(narrative, function(response) {
        		$('#modalNewNarrative').modal('hide');
				toastr.success("Narrative has been saved");

        		loadNarrativeList();
			});
		});
	};

	var loadNarrativeList = function() {
		var data = {film_id: $('#film-edit-form input[name="id"]').val()};
		KubrickApp.narrative.find(data, function(response) {
			var $list = $('#narrative-list');
			var template = new Template('#narrative-list-item');
			$list.find("li").remove();
			for ( var x = 0; x < response.length; x++ ) {
				// $list.append('<li><a href="#" rel="'+response[x].id+'">'+response[x].code+' - '+response[x].name+' ('+response[x].venue+')</a></li>');
				$list.append(template.render(response[x]));
			}
		});
	}

	var structureAdd = function() {
		$('#structure-add-btn').click(function(e) {
			$('#structure-new-form').trigger("reset");
			$('#modalNewStructure').modal('show');
    	});
	};

	var structureEdit = function() {
		$('#structure-list').on('click', 'a', function(e) {
			e.preventDefault();
			var id = $(this).attr('rel');
			KubrickApp.structure.read(id, function(response) {
				$('#structure-view-btn').attr('rel', response.id);
				
				$('#structure-id').val(response.id);
				$('#structure-name').val(response.name);
				$('#structure-venue').val(response.venue);
				$('#structure-code').val(response.code);
				$('#structure-image').val("");
				$('#structure-description').val(response.description);
				$('#modalNewStructure').modal('show');
			});
    	});
	};

	var structureView = function() {
		$('#structure-view-btn').click(function() {
			var id = $(this).attr('rel');
			window.location = '/admin/films/'+filmId+'/structures/'+id;
		});
	};

	var structureSave = function() {
		$('#structure-save-btn').click(function() {
			var structure = {};
			structure.film_id = $('#film-edit-form input[name="id"]').val();
			structure.id = $('#structure-id').val();
			structure.venue = $('#structure-venue').val();
			structure.name = $('#structure-name').val();
			structure.code = $('#structure-code').val();
			structure.description = $('#structure-description').val();
			KubrickApp.structure.save(structure, function(response) {
        		$('#modalNewStructure').modal('hide');
				toastr.success("Structure has been saved");

        		loadStructureList();
			});
		});
	};

	var loadStructureList = function() {
		var data = {film_id: $('#film-edit-form input[name="id"]').val()};
		KubrickApp.structure.find(data, function(response) {
			var $list = $('#structure-list');
			var template = new Template('#structure-list-item');
			$list.find("li").remove();
			for ( var x = 0; x < response.length; x++ ) {
				// $list.append('<li><a href="#" rel="'+response[x].id+'">'+response[x].code+' - '+response[x].name+' ('+response[x].venue+')</a></li>');
				$list.append(template.render(response[x]));
			}
		});
	}

	return {
        //main function to initiate the module
        init: function () {
        	
        	loadUserList();
        	userEdit();
        	userSave();
        	credentialEdit();
        	credentialSave();
        }
    };
}();

jQuery(document).ready(function() {
    ModuleUser.init();
});