import DashboardUI from "../dashboard-ui/dashboard-ui.js"

//== Class definition
var ModuleMedia = function() {
	var dataTable;
	var loadMediaList = function() {
		dataTable = $('#dataTable').DataTable({
			ajax: {
				url: '/api/admin/medias',
				dataSrc: 'list'
			},
			aoColumnDefs: [
		        { "bSortable": false, "aTargets": [ 2 ] }, 
		        { "bSearchable": false, "aTargets": [ 2 ] }
		    ],
			columns: [
		        { data: 'name' },
		        { data: 'description' },
		        {
				  data: null,
				  render: function ( data, type, row ) {
				    return '<button class="btn btn-sm btn-warning edit-btn"><i class="fa fa-pencil"></i></button> ' 
				    +'&nbsp;<button class="btn btn-sm btn-secondary publish-btn"><i class="fa fa-globe"></i></button>';
				  }
				}
		    ]
		});
	};
	
	var mediaEdit = function() {
		$('#dataTable').on('click', '.edit-btn', function(e) {
			e.preventDefault();
			var data = dataTable.row( $(this).parents('tr') ).data();
			// console.log(data);
			var media_id = data.media_id;
			app.api.media.read(media_id, function(response) {
				$('#media-id').val(response.data.media_id);
				$('#media-name').val(response.data.name);
				$('#media-description').val(response.data.description);

				$('#modalNewMedia').modal('show');
			});
    	});
	};

	var mediaSave = function() {
		$('#media-save-btn').click(function() {
			var media = {};
			media.media_id = $('#media-id').val();
			media.name = $('#media-name').val();
			media.description = $('#media-description').val();
			app.api.media.save(media, function(response) {
        		$('#modalNewMedia').modal('hide');
				app.ui.notice("Media has been saved");
        		dataTable.ajax.reload();
			});
		});
	};

	return {
        //main function to initiate the module
        init: function () {
        	
        	loadMediaList();
        	mediaEdit();
        	mediaSave();
        	
        	feather.replace();
        }
    };
}();

jQuery(document).ready(function() {
    ModuleMedia.init();
});

export default ModuleMedia;