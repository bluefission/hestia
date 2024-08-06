//== Class definition
var PageQuestboard = function() {

	var loadQuests = function() {

		AyemaApp.user.initiatives(function(response) {
			var $list = $('#initiative-list');
			var template = new Template('#initiative-list-item');
			var delay = 1000; 
			for ( var x = 0; x < response.list.length; x++ ) {
				var $panel = $(template.render(response.list[x]));
				$panel.hide();
				$list.append($panel);
				$panel.fadeIn(delay);
				delay += 500;
			}
		});
	};

	var viewQuest = function() {
		$('#initiative-list').on('click', '.initiative-review-btn', function(e) {
			e.preventDefault();
			var $btn = $(this);
			$('#modalInitiative').modal('hide');
			if ( $btn.hasClass('red') ) {
				$btn.toggleClass('red');

				$btn.text('Review');
				$btn.closest('.frnd-finder').find('.progress-bar').css('width', '0%');
				$btn.closest('.frnd-finder').find('.user-count').text('0');
			} else {
				var id = $(this).closest('.match-info').attr('rel');
				AyemaApp.user.initiative(id, function(response) {
					$('#initiative-accept-btn').attr('rel', response.data.initiative_id);
					$('#initiativeModalLabel').text(response.data.name);
					$('#initiative-description').text(response.data.description);
					$('#modalInitiative').modal('show');
				});
			}
		});
	};

	var acceptQuest = function() {
		$('#initiative-accept-btn').click(function() {

			var id = $(this).attr('rel');
			var $btn = $('#lobby-'+id).find('.initiative-review-btn');
			AyemaApp.user.initiative_accept(function(response) {
				$btn.toggleClass('red');
				if ( $btn.hasClass('red') ) {
					$('#modalInitiative').modal('hide');

					$btn.text('Cancel');
					$btn.closest('.frnd-finder').find('.progress-bar').css('width', '100%');
					$btn.closest('.frnd-finder').find('.user-count').text('1');
					var load = setTimeout(function() {
						DashboardUI.confirm("Are you prepared to begin this quest?", function (r) {
							if ( r ) {
								window.location = '\lobby';
							} else {
								$btn.trigger('click');
							}
						});
					}, 2000);
				}
			});
		});
	};

	return {
        //main function to initiate the module
        init: function () {
        	loadQuests();
        	viewQuest();
        	acceptQuest();
        }
    };
}();

jQuery(document).ready(function() {
    PageQuestboard.init();
});