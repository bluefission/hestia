//== Class definition
var ModuleInitiative = function() {
	var dataTable;
	var loadInitiativeList = function() {
		dataTable = $('#dataTable').DataTable({
			ajax: {
				url: '/api/admin/initiatives',
				dataSrc: 'list'
			},
			aoColumnDefs: [
		        { "bSortable": false, "aTargets": [ 2 ] }, 
		        { "bSearchable": false, "aTargets": [ 2 ] }
		    ],
			columns: [
		        { data: 'name' },
		        { 
		        	data: 'description',
			        render: function ( data, type, row ) {
			            return type === 'display' && data.length > 75 ?
				        data.substr( 0, 75 ) +'…' :
				        data;
			        } 
			    },
		        {
				  data: null,
				  render: function ( data, type, row ) {
				    return '<button class="btn btn-sm btn-warning edit-btn"><i class="fa fa-pencil"></i></button> '
				    +'<button class="btn btn-sm btn-default kpi-types-btn"><i class="fa fa-bullseye"></i></button> '
				    +'<button class="btn btn-sm btn-default prerequisites-btn"><i class="fa fa-flag"></i></button> '
				    +'<button class="btn btn-sm btn-default conditions-btn"><i class="fa fa-star"></i></button> '
				    +'<button class="btn btn-sm btn-default rewards-btn"><i class="fa fa-trophy"></i></button> '
				    +'<button class="btn btn-sm btn-default script-btn"><i class="fa fa-comment"></i></button> ';
				  }
				}
		    ]
		});
	};

	var initiativeNew = function() {
		$('#initiative-new-btn').click(function(e) {
			e.preventDefault();
			$('#initiative-id').val("");
			$('#initiative-name').val("");
			$('#initiative-description').val("");

			$('#initiative-initiative-type-id').val("");
			$('#initiative-initiative-span-id').val("");
			$('#initiative-initiative-status-id').val("");
			$('#initiative-initiative-privacy-type-id').val("");

			$('#modalNewInitiative').modal('show');
		});
	};
	
	var initiativeEdit = function() {
		$('#dataTable').on('click', '.edit-btn', function(e) {
			e.preventDefault();
			var data = dataTable.row( $(this).parents('tr') ).data();
			var initiative_id = data.initiative_id;
			BlueFissionApp.admin_initiative.read(initiative_id, function(response) {
				$('#initiative-id').val(response.data.initiative_id);
				$('#initiative-name').val(response.data.name);
				$('#initiative-description').val(response.data.description);

				$('#initiative-initiative-type-id').val(response.data.initiative_type_id);
				$('#initiative-initiative-span-id').val(response.data.initiative_span_id);
				$('#initiative-initiative-status-id').val(response.data.initiative_status_id);
				$('#initiative-initiative-privacy-type-id').val(response.data.initiative_privacy_type_id);

				$('#modalNewInitiative').modal('show');
			});
    	});
	};

	var initiativeSave = function() {
		$('#initiative-save-btn').click(function() {
			var initiative = {};
			initiative.initiative_id = $('#initiative-id').val();
			initiative.name = $('#initiative-name').val();
			initiative.description = $('#initiative-description').val();

			initiative.initiative_type_id = $('#initiative-initiative-type-id').val();
			initiative.initiative_span_id = $('#initiative-initiative-span-id').val();
			initiative.initiative_status_id = $('#initiative-initiative-status-id').val();
			initiative.initiative_privacy_type_id = $('#initiative-initiative-privacy-type-id').val();
			BlueFissionApp.admin_initiative.save(initiative, function(response) {
        		$('#modalNewInitiative').modal('hide');
				toastr.success("Initiative has been saved");
        		dataTable.ajax.reload();
			});
		});
	};


	// --
	// Initiative Types

	var loadInitiativeTypeList = function() {
		BlueFissionApp.admin_initiative_type.list(function(response) {
			var $list = $('#initiative-initiative-type-id');
			var $list2 = $('#initiative-type');
			var template = new Template('#initiative-type-list-item');
			$list.find('option').remove();
			$list2.find('option').remove();
			for ( var x = 0; x < response.list.length; x++ ) {
				$list.append(template.render(response.list[x]));
				$list2.append(template.render(response.list[x]));
			}
		});
	};

	var initiativeTypeNew = function() {
		$('#initiative-type-new-btn').click(function(e) {
			e.preventDefault();
			$('#initiative-type-id').val("");
			$('#initiative-type-name').val("");
			$('#initiative-type-label').val("");
			$('#initiative-type-description').val("");

			$('#modalNewInitiativeType').modal('show');
		});
	};
	
	var initiativeTypeEdit = function() {
		$('#initiative-type-edit-btn').click(function(e) {
			e.preventDefault();
			var initiative_type_id = $('#initiative-type').val();
			BlueFissionApp.admin_initiative_type.read(initiative_type_id, function(response) {
				$('#initiative-type-id').val(response.data.initiative_type_id);
				$('#initiative-type-label').val(response.data.label);
				$('#initiative-type-name').val(response.data.name);
				$('#initiative-type-description').val(response.data.description);

				$('#modalNewInitiativeType').modal('show');
			});
    	});
	};

	var initiativeTypeSave = function() {
		$('#initiative-type-save-btn').click(function(e) {
			e.preventDefault();
			var initiative_type = {};
			initiative_type.initiative_type_id = $('#initiative-type-id').val();
			initiative_type.name = $('#initiative-type-name').val();
			initiative_type.label = $('#initiative-type-label').val();
			initiative_type.description = $('#initiative-type-description').val();
			BlueFissionApp.admin_initiative_type.save(initiative_type, function(response) {
        		$('#modalNewInitiativeType').modal('hide');
				toastr.success("Initiative Type has been saved");
				loadInitiativeTypeList();
			});
		});
	};
	
	
	// --
	// Initiative Spans

	var loadInitiativeSpanList = function() {
		BlueFissionApp.admin_initiative_span.list(function(response) {
			var $list = $('#initiative-initiative-span-id');
			var $list2 = $('#initiative-span');
			var template = new Template('#initiative-span-list-item');
			$list.find('option').remove();
			$list2.find('option').remove();
			for ( var x = 0; x < response.list.length; x++ ) {
				$list.append(template.render(response.list[x]));
				$list2.append(template.render(response.list[x]));
			}
		});
	};

	var initiativeSpanNew = function() {
		$('#initiative-span-new-btn').click(function(e) {
			e.preventDefault();
			$('#initiative-span-id').val("");
			$('#initiative-span-name').val("");
			$('#initiative-span-label').val("");
			$('#initiative-span-description').val("");

			$('#modalNewInitiativeSpan').modal('show');
		});
	};
	
	var initiativeSpanEdit = function() {
		$('#initiative-span-edit-btn').click(function(e) {
			e.preventDefault();
			var initiative_span_id = $('#initiative-span').val();
			BlueFissionApp.admin_initiative_span.read(initiative_span_id, function(response) {
				$('#initiative-span-id').val(response.data.initiative_span_id);
				$('#initiative-span-label').val(response.data.label);
				$('#initiative-span-name').val(response.data.name);
				$('#initiative-span-description').val(response.data.description);

				$('#modalNewInitiativeSpan').modal('show');
			});
    	});
	};

	var initiativeSpanSave = function() {
		$('#initiative-span-save-btn').click(function(e) {
			e.preventDefault();
			var initiative_span = {};
			initiative_span.initiative_span_id = $('#initiative-span-id').val();
			initiative_span.name = $('#initiative-span-name').val();
			initiative_span.label = $('#initiative-span-label').val();
			initiative_span.description = $('#initiative-span-description').val();
			BlueFissionApp.admin_initiative_span.save(initiative_span, function(response) {
        		$('#modalNewInitiativeSpan').modal('hide');
				toastr.success("Initiative Span has been saved");
				loadInitiativeSpanList();
			});
		});
	};
	
	
	// --
	// Initiative Statuses

	var loadInitiativeStatusList = function() {
		BlueFissionApp.admin_initiative_status.list(function(response) {
			var $list = $('#initiative-initiative-status-id');
			var $list2 = $('#initiative-status');
			var template = new Template('#initiative-status-list-item');
			$list.find('option').remove();
			$list2.find('option').remove();
			for ( var x = 0; x < response.list.length; x++ ) {
				$list.append(template.render(response.list[x]));
				$list2.append(template.render(response.list[x]));
			}
		});
	};

	var initiativeStatusNew = function() {
		$('#initiative-status-new-btn').click(function(e) {
			e.preventDefault();
			$('#initiative-status-id').val("");
			$('#initiative-status-name').val("");
			$('#initiative-status-label').val("");
			$('#initiative-status-description').val("");

			$('#modalNewInitiativeStatus').modal('show');
		});
	};
	
	var initiativeStatusEdit = function() {
		$('#initiative-status-edit-btn').click(function(e) {
			e.preventDefault();
			var initiative_status_id = $('#initiative-status').val();
			BlueFissionApp.admin_initiative_status.read(initiative_status_id, function(response) {
				$('#initiative-status-id').val(response.data.initiative_status_id);
				$('#initiative-status-label').val(response.data.label);
				$('#initiative-status-name').val(response.data.name);
				$('#initiative-status-description').val(response.data.description);

				$('#modalNewInitiativeStatus').modal('show');
			});
    	});
	};

	var initiativeStatusSave = function() {
		$('#initiative-status-save-btn').click(function(e) {
			e.preventDefault();
			var initiative_status = {};
			initiative_status.initiative_status_id = $('#initiative-status-id').val();
			initiative_status.name = $('#initiative-status-name').val();
			initiative_status.label = $('#initiative-status-label').val();
			initiative_status.description = $('#initiative-status-description').val();
			BlueFissionApp.admin_initiative_status.save(initiative_status, function(response) {
        		$('#modalNewInitiativeStatus').modal('hide');
				toastr.success("Initiative Status has been saved");
				loadInitiativeStatusList();
			});
		});
	};

	// --
	// Initiative Privacy Types

	var loadInitiativePrivacyTypeList = function() {
		BlueFissionApp.admin_initiative_privacy_type.list(function(response) {
			var $list = $('#initiative-initiative-privacy-type-id');
			var $list2 = $('#initiative-privacy-type');
			var template = new Template('#initiative-privacy-type-list-item');
			$list.find('option').remove();
			$list2.find('option').remove();
			for ( var x = 0; x < response.list.length; x++ ) {
				$list.append(template.render(response.list[x]));
				$list2.append(template.render(response.list[x]));
			}
		});
	};

	var initiativePrivacyTypeNew = function() {
		$('#initiative-privacy-type-new-btn').click(function(e) {
			e.preventDefault();
			$('#initiative-privacy-type-id').val("");
			$('#initiative-privacy-type-name').val("");
			$('#initiative-privacy-type-label').val("");
			$('#initiative-privacy-type-description').val("");

			$('#modalNewInitiativePrivacyType').modal('show');
		});
	};
	
	var initiativePrivacyTypeEdit = function() {
		$('#initiative-privacy-type-edit-btn').click(function(e) {
			e.preventDefault();
			var initiative_privacy_type_id = $('#initiative-privacy-type').val();
			BlueFissionApp.admin_initiative_privacy_type.read(initiative_privacy_type_id, function(response) {
				$('#initiative-privacy-type-id').val(response.data.initiative_privacy_type_id);
				$('#initiative-privacy-type-label').val(response.data.label);
				$('#initiative-privacy-type-name').val(response.data.name);
				$('#initiative-privacy-type-description').val(response.data.description);

				$('#modalNewInitiativePrivacyType').modal('show');
			});
    	});
	};

	var initiativePrivacyTypeSave = function() {
		$('#initiative-privacy-type-save-btn').click(function(e) {
			e.preventDefault();
			var initiative_privacy_type = {};
			initiative_privacy_type.initiative_privacy_type_id = $('#initiative-privacy-type-id').val();
			initiative_privacy_type.name = $('#initiative-privacy-type-name').val();
			initiative_privacy_type.label = $('#initiative-privacy-type-label').val();
			initiative_privacy_type.description = $('#initiative-privacy-type-description').val();
			BlueFissionApp.admin_initiative_privacy_type.save(initiative_privacy_type, function(response) {
        		$('#modalNewInitiativePrivacyType').modal('hide');
				toastr.success("Initiative Privacy Type has been saved");
				loadInitiativePrivacyTypeList();
			});
		});
	};

	// --
	// List item values
	// -------

	var loadAttributeList = function() {
		BlueFissionApp.admin_attribute.list(function(response) {
			var $list1 = $('.prerequisites-attribute-id');
			var $list2 = $('.conditions-attribute-id');
			var template = new Template('#attribute-list-item');
			// $list.find('option').remove();
			for ( var x = 0; x < response.list.length; x++ ) {
				$list1.append(template.render(response.list[x]));
				$list2.append(template.render(response.list[x]));
			}
		});
	};

	var loadOperatorList = function() {
		BlueFissionApp.admin_operator.list(function(response) {
			var $list1 = $('.prerequisites-operator-id');
			var $list2 = $('.conditions-operator-id');
			var template = new Template('#operator-list-item');
			// $list.find('option').remove();
			for ( var x = 0; x < response.list.length; x++ ) {
				$list1.append(template.render(response.list[x]));
				$list2.append(template.render(response.list[x]));
			}
		});
	};

	var loadUnitTypeList = function() {
		BlueFissionApp.admin_unit_type.list(function(response) {
			var $list1 = $('.prerequisites-unit-type-id');
			var $list2 = $('.conditions-unit-type-id');
			var template = new Template('#unit-type-list-item');
			// $list.find('option').remove();
			for ( var x = 0; x < response.list.length; x++ ) {
				$list1.append(template.render(response.list[x]));
				$list2.append(template.render(response.list[x]));
			}
		});
	};

	var loadKpiTypeList = function() {
		BlueFissionApp.admin_kpi_type.list(function(response) {
			var $list1 = $('.kpi-type-id');
			var $list2 = $('.conditions-kpi-type-id');
			var template = new Template('#kpi-type-list-item');
			$list1.find('option').remove();
			for ( var x = 0; x < response.list.length; x++ ) {
				$list1.append(template.render(response.list[x]));
				$list2.append(template.render(response.list[x]));
			}
		});
	};

	// -- 
	// Initiative Prerequisites
	// 
	
	var initiativePrerequisiteEdit = function() {
		$('#dataTable').on('click', '.prerequisites-btn', function(e) {
			e.preventDefault();
			var data = dataTable.row( $(this).parents('tr') ).data();
			var initiative_id = data.initiative_id;

			$('#prerequisites-initiative-id').val(initiative_id);
			BlueFissionApp.admin_initiative.prerequisites(initiative_id, function(response) {
				var $deleted = $('.prerequisites-deleted').last().clone();
				$deleted.val("");
				$('.prerequisites-deleted').remove();

				$('#prerequisites-initiative-id').after($deleted);
				
				var $entry_row = $('.prerequisite-entry').last().clone();
				$entry_row.find('select,input').val("");
				$('.prerequisite-entry').remove();

				var list = response.list;

				if ( list.length == 0 ) {
					$('#prerequisite-controls').before($entry_row);
				}

				for ( var x = 0; x < list.length; x++ ) {
					$new_row = $entry_row.clone();
					$new_row.find('.prerequisites-id').val( list[x].prerequisite_id );
					$new_row.find('.prerequisites-attribute-id').val( list[x].attribute_id );
					$new_row.find('.prerequisites-operator-id').val( list[x].operator_id );
					$new_row.find('.prerequisites-value').val( list[x].value );
					$('#prerequisite-controls').before($new_row);
				}

				$entries = $('.prerequisite-entry');
				if ( $entries.length > 1 ) {
					$('.prerequisite-remove-btn').show();
				} else {
					$('.prerequisite-remove-btn').hide();
				}
				$('#modalPrerequisites').modal('show');
			});
    	});
	};

	var initiativePrerequisiteAdd = function() {
		$('#prerequisites-add-btn').click(function(e) {
			e.preventDefault();
			var $entry_row = $('.prerequisite-entry').last().clone();
			$entry_row.find('select,input').val("");
			$('#prerequisite-controls').before($entry_row);
			$('.prerequisite-remove-btn').show();
		});
	};

	var initiativePrerequisiteRemove = function() {
		$('.prerequisite-remove-btn').hide();
		$('#prerequisites-form').on('click', '.prerequisite-remove-btn', function(e) {
			e.preventDefault();
			$entries = $('.prerequisite-entry');
			if ( $entries.length > 1 ) {
				var id = $(this).closest('.row').find('.prerequisites-id').val();
				// $('#prerequisites-deleted').val( id +','+$('#prerequisites-deleted').val());
				alert(id);
				var $deleted = $('.prerequisites-deleted').last();
				if ( $deleted.val() ) {
					var $new_deleted = $deleted.clone();
					$new_deleted.val(id);
					$deleted.after($new_deleted);
				} else {
					$deleted.val(id);
				}
				

				$(this).closest('.row').remove();
				if ( $entries.length < 2 ) {
					$('.prerequisite-remove-btn').hide();
				}
			}
		});
	};

	var initiativePrerequisiteSave = function() {
		$('#prerequisites-save-btn').click(function(e) {
			e.preventDefault();

			var ids = [];
			var attributes = [];
			var operators = [];
			var values = [];
			var deleted = [];
			$('.prerequisites-id').each(function() { ids.push($(this).val()); });
			$('.prerequisites-attribute-id').each(function() { attributes.push($(this).val()); });
			$('.prerequisites-operator-id').each(function() { operators.push($(this).val()); });
			$('.prerequisites-value').each(function() { values.push($(this).val()); });
			$('.prerequisites-deleted').each(function() { deleted.push($(this).val()); });

			var data =  {
				initiative_id: $('#prerequisites-initiative-id').val(),
				prerequisite_ids: ids,
				attributes: attributes,
				operators: operators,
				values: values,
				deleted: deleted,
			};

			BlueFissionApp.admin_prerequisite.bulk_save(data, function(response) {
				toastr.success("Prerequisites have been saved");
				$('#modalPrerequisites').modal('hide');
			});
		});
	};


	// -- 
	// Initiative to KPI Types
	// 
	
	var initiativeKpiTypeEdit = function() {
		$('#dataTable').on('click', '.kpi-types-btn', function(e) {
			e.preventDefault();
			var data = dataTable.row( $(this).parents('tr') ).data();
			var initiative_id = data.initiative_id;

			$('#kpi-type-initiative-id').val(initiative_id);
			BlueFissionApp.admin_initiative.kpi_types(initiative_id, function(response) {
				var $deleted = $('.kpi-types-deleted').last().clone();
				$deleted.val("");
				$('.kpi-types-deleted').remove();

				$('#kpi-type-initiative-id').after($deleted);
				
				var $entry_row = $('.kpi-type-entry').last().clone();
				$entry_row.find('select,input').val("");
				$('.kpi-type-entry').remove();

				var list = response.list;

				if ( list.length == 0 ) {
					$('#kpi-type-controls').before($entry_row);
				}

				for ( var x = 0; x < list.length; x++ ) {
					$new_row = $entry_row.clone();
					$new_row.find('.kpi-types-id').val( list[x].kpi_type_id );
					$('#kpi-type-controls').before($new_row);
				}

				$('#kpi-type-initiative-id').after($deleted);
				$entries = $('.kpi-type-entry');
				if ( $entries.length > 1 ) {
					$('.kpi-type-remove-btn').show();
				} else {
					$('.kpi-type-remove-btn').hide();
				}
				$('#modalKpiTypes').modal('show');
			});
    	});
	};

	var initiativeKpiTypeAdd = function() {
		$('#kpi-types-add-btn').click(function(e) {
			e.preventDefault();
			var $entry_row = $('.kpi-type-entry').last().clone();
			$entry_row.find('select,input').val("");
			$('#kpi-type-controls').before($entry_row);
			$('.kpi-type-remove-btn').show();
		});
	};

	var initiativeKpiTypeRemove = function() {
		$('.kpi-type-remove-btn').hide();
		$('#kpi-types-form').on('click', '.kpi-type-remove-btn', function(e) {
			e.preventDefault();
			$entries = $('.kpi-type-entry');
			if ( $entries.length > 1 ) {
				var id = $(this).closest('.row').find('.kpi-types-id').val();
				// $('#kpi-types-deleted').val( id +','+$('#kpi-types-deleted').val());
				alert(id);
				var $deleted = $('.kpi-types-deleted').last();
				if ( $deleted.val() ) {
					var $new_deleted = $deleted.clone();
					$new_deleted.val(id);
					$deleted.after($new_deleted);
				} else {
					$deleted.val(id);
				}
				

				$(this).closest('.row').remove();
				if ( $entries.length < 2 ) {
					$('.kpi-type-remove-btn').hide();
				}
			}
		});
	};

	var initiativeKpiTypeSave = function() {
		$('#kpi-types-save-btn').click(function(e) {
			e.preventDefault();

			var ids = [];
			$('.kpi-type-id').each(function() { ids.push($(this).val()); });

			var data =  {
				initiative_id: $('#kpi-type-initiative-id').val(),
				kpi_type_ids: ids
			};

			BlueFissionApp.admin_initiative.kpi_types_save(data, function(response) {
				toastr.success("KPI Types have been saved");
				$('#modalKpiTypes').modal('hide');
			});
		});
	};



	// -- 
	// Initiative Conditions
	// 
	
	var initiativeConditionEdit = function() {
		$('#dataTable').on('click', '.conditions-btn', function(e) {
			e.preventDefault();
			var data = dataTable.row( $(this).parents('tr') ).data();
			var initiative_id = data.initiative_id;

			$('#conditions-initiative-id').val(initiative_id);
			BlueFissionApp.admin_initiative.conditions(initiative_id, function(response) {
				var $deleted = $('.conditions-deleted').last().clone();
				$deleted.val("");
				$('.conditions-deleted').remove();

				$('#conditions-initiative-id').after($deleted);
				
				var $entry_row = $('.condition-entry').last().clone();
				$entry_row.find('select,input').val("");
				$('.condition-entry').remove();

				var list = response.list;

				if ( list.length == 0 ) {
					$('#condition-controls').before($entry_row);
				}

				for ( var x = 0; x < list.length; x++ ) {
					$new_row = $entry_row.clone();
					$new_row.find('.conditions-id').val( list[x].condition_id );
					$new_row.find('.conditions-kpi-type-id').val( list[x].kpi_type_id );
					$new_row.find('.conditions-operator-id').val( list[x].operator_id );
					$new_row.find('.conditions-value').val( list[x].value );
					$('#condition-controls').before($new_row);
				}

				$entries = $('.condition-entry');
				if ( $entries.length > 1 ) {
					$('.condition-remove-btn').show();
				} else {
					$('.condition-remove-btn').hide();
				}
				$('#modalConditions').modal('show');
			});
    	});
	};

	var initiativeConditionAdd = function() {
		$('#conditions-add-btn').click(function(e) {
			e.preventDefault();
			var $entry_row = $('.condition-entry').last().clone();
			$entry_row.find('select,input').val("");
			$('#condition-controls').before($entry_row);
			$('.condition-remove-btn').show();
		});
	};

	var initiativeConditionRemove = function() {
		$('.condition-remove-btn').hide();
		$('#conditions-form').on('click', '.condition-remove-btn', function(e) {
			e.preventDefault();
			$entries = $('.condition-entry');
			if ( $entries.length > 1 ) {
				var id = $(this).closest('.row').find('.conditions-id').val();
				// $('#conditions-deleted').val( id +','+$('#conditions-deleted').val());
				alert(id);
				var $deleted = $('.conditions-deleted').last();
				if ( $deleted.val() ) {
					var $new_deleted = $deleted.clone();
					$new_deleted.val(id);
					$deleted.after($new_deleted);
				} else {
					$deleted.val(id);
				}
				

				$(this).closest('.row').remove();
				if ( $entries.length < 2 ) {
					$('.condition-remove-btn').hide();
				}
			}
		});
	};

	var initiativeConditionSave = function() {
		$('#conditions-save-btn').click(function(e) {
			e.preventDefault();

			var ids = [];
			var kpi_types = [];
			var operators = [];
			var values = [];
			var deleted = [];
			$('.conditions-id').each(function() { ids.push($(this).val()); });
			$('.conditions-kpi-type-id').each(function() { kpi_types.push($(this).val()); });
			$('.conditions-operator-id').each(function() { operators.push($(this).val()); });
			$('.conditions-value').each(function() { values.push($(this).val()); });
			$('.conditions-deleted').each(function() { deleted.push($(this).val()); });

			var data =  {
				initiative_id: $('#conditions-initiative-id').val(),
				condition_ids: ids,
				kpi_types: kpi_types,
				operators: operators,
				values: values,
				deleted: deleted,
			};

			BlueFissionApp.admin_condition.bulk_save(data, function(response) {
				toastr.success("Conditions have been saved");
				$('#modalConditions').modal('hide');
			});
		});
	};

	return {
        //main function to initiate the module
        init: function () {
        	
        	loadInitiativeList();
        	initiativeNew();
        	initiativeEdit();
        	initiativeSave();

        	loadInitiativeTypeList();
        	initiativeTypeNew();
        	initiativeTypeEdit();
        	initiativeTypeSave();

        	loadInitiativeSpanList();
        	initiativeSpanNew();
        	initiativeSpanEdit();
        	initiativeSpanSave();

        	loadInitiativeStatusList();
        	initiativeStatusNew();
        	initiativeStatusEdit();
        	initiativeStatusSave();

        	loadInitiativePrivacyTypeList();
        	initiativePrivacyTypeNew();
        	initiativePrivacyTypeEdit();
        	initiativePrivacyTypeSave();

        	loadAttributeList();
			loadOperatorList();
			loadUnitTypeList();

			loadKpiTypeList();
        	initiativeKpiTypeEdit();
        	initiativeKpiTypeAdd();
        	initiativeKpiTypeRemove();
        	initiativeKpiTypeSave();

        	initiativePrerequisiteEdit();
        	initiativePrerequisiteAdd();
        	initiativePrerequisiteRemove();
        	initiativePrerequisiteSave();

        	initiativeConditionEdit();
        	initiativeConditionAdd();
        	initiativeConditionRemove();
        	initiativeConditionSave();
        }
    };
}();

jQuery(document).ready(function() {
    ModuleInitiative.init();
});