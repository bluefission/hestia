//== Class definition
var ModuleInitiativeMetric = function() {
	var dataTable;
	var kpiCategories = {};
	var loadKpiTypeList = function() {
		dataTable = $('#dataTable').DataTable({
			ajax: {
				url: '/api/admin/kpi_types',
				dataSrc: 'list'
			},
			aoColumnDefs: [
		        { "bSortable": false, "aTargets": [ 3 ] }, 
		        { "bSearchable": false, "aTargets": [ 3 ] }
		    ],
			columns: [
		        { data: 'name' },
		        { 
		        	data: 'kpi_category_id',
		        	render: function( data, type, row ) {
		        		return kpiCategories[data];
		        	}
		        },
		        { data: 'description' },
		        {
				  data: null,
				  render: function ( data, type, row ) {
				    return '<button class="btn btn-sm btn-warning edit-btn"><i class="fa fa-pencil"></i></button> ';
				  }
				}
		    ]
		});
	};

	var kpiTypeNew = function() {
		$('#kpi-type-new-btn').click(function(e) {
			e.preventDefault();
			$('#kpi-type-id').val("");
			$('#kpi-type-name').val("");
			$('#kpi-type-category-id').val("");
			$('#kpi-type-label').val("");
			$('#kpi-type-description').val("");

			$('#modalNewKpiType').modal('show');
		});
	};
	
	var kpiTypeEdit = function() {
		$('#dataTable').on('click', '.edit-btn', function(e) {
			e.preventDefault();
			var data = dataTable.row( $(this).parents('tr') ).data();
			var kpi_type_id = data.kpi_type_id;
			BlueFissionApp.admin_kpi_type.read(kpi_type_id, function(response) {
				$('#kpi-type-id').val(response.data.kpi_type_id);
				$('#kpi-type-name').val(response.data.name);
				$('#kpi-type-label').val(response.data.label);
				$('#kpi-type-description').val(response.data.description);

				$('#kpi-unit-type-id').val(response.data.unit_type_id)
				$('#kpi-type-category-id').val(response.data.kpi_category_id);
				 // $('#kpi-type-status-id').val(response.data.kpi_type_status_id);
				 // $('#kpi-type-privacy-type-id').val(response.data.kpi_type_privacy_type_id);

				$('#modalNewKpiType').modal('show');
			});
    	});
	};

	var kpiTypeSave = function() {
		$('#kpi-type-save-btn').click(function() {
			var kpi_type = {};
			kpi_type.kpi_type_id = $('#kpi-type-id').val();
			kpi_type.name = $('#kpi-type-name').val();
			kpi_type.label = $('#kpi-type-label').val();
			kpi_type.description = $('#kpi-type-description').val();

			kpi_type.unit_type_id = $('#kpi-unit-type-id').val();
			kpi_type.kpi_category_id = $('#kpi-type-category-id').val();
			// kpi_type.kpi_type_status_id = $('#kpi-type-status-id').val();
			// kpi_type.kpi_type_privacy_type_id = $('#kpi-type-privacy-type-id').val();
			BlueFissionApp.admin_kpi_type.save(kpi_type, function(response) {
        		$('#modalNewKpiType').modal('hide');
				toastr.success("Kpi Type has been saved");
        		dataTable.ajax.reload();
			});
		});
	};


	// --
	// KPI Types

	var loadKpiCategoryList = function() {
		BlueFissionApp.admin_kpi_category.list(function(response) {
			var $list = $('#kpi-type-category-id');
			var $list2 = $('#kpi-category');
			var template = new Template('#kpi-category-list-item');
			$list.find('option').remove();
			$list2.find('option').remove();
			for ( var x = 0; x < response.list.length; x++ ) {
				$list.append(template.render(response.list[x]));
				$list2.append(template.render(response.list[x]));
				kpiCategories[ response.list[x].kpi_category_id ] = response.list[x].label;
			}
        	loadKpiTypeList();
		});
	};

	var kpiCategoryNew = function() {
		$('#kpi-category-new-btn').click(function(e) {
			e.preventDefault();
			$('#kpi-category-id').val("");
			$('#kpi-category-name').val("");
			$('#kpi-category-label').val("");
			$('#kpi-category-description').val("");

			$('#modalNewKpiCategory').modal('show');
		});
	};
	
	var kpiCategoryEdit = function() {
		$('#kpi-category-edit-btn').click(function(e) {
			e.preventDefault();
			var kpi_category_id = $('#kpi-category').val();
			BlueFissionApp.admin_kpi_category.read(kpi_category_id, function(response) {
				$('#kpi-category-id').val(response.data.kpi_category_id);
				$('#kpi-category-label').val(response.data.label);
				$('#kpi-category-name').val(response.data.name);
				$('#kpi-category-description').val(response.data.description);

				$('#modalNewKpiCategory').modal('show');
			});
    	});
	};

	var kpiCategorySave = function() {
		$('#kpi-category-save-btn').click(function(e) {
			e.preventDefault();
			var kpi_category = {};
			kpi_category.kpi_category_id = $('#kpi-category-id').val();
			kpi_category.name = $('#kpi-category-name').val();
			kpi_category.label = $('#kpi-category-label').val();
			kpi_category.description = $('#kpi-category-description').val();
			BlueFissionApp.admin_kpi_category.save(kpi_category, function(response) {
        		$('#modalNewKpiCategory').modal('hide');
				toastr.success("KPI Type has been saved");
				loadKpiCategoryList();
			});
		});
	};

	// --
	// Attributes

	var loadAttributeList = function() {
		BlueFissionApp.admin_attribute.list(function(response) {
			var $list = $('#attribute-id');
			var $list2 = $('#attribute');
			var template = new Template('#attribute-list-item');
			$list.find('option').remove();
			$list2.find('option').remove();
			for ( var x = 0; x < response.list.length; x++ ) {
				$list.append(template.render(response.list[x]));
				$list2.append(template.render(response.list[x]));
			}
		});
	};

	var attributeNew = function() {
		$('#attribute-new-btn').click(function(e) {
			e.preventDefault();
			$('#attribute-id').val("");
			$('#attribute-name').val("");
			$('#attribute-label').val("");
			$('#attribute-description').val("");

			$('#modalNewAttribute').modal('show');
		});
	};
	
	var attributeEdit = function() {
		$('#attribute-edit-btn').click(function(e) {
			e.preventDefault();
			var attribute_id = $('#attribute').val();
			BlueFissionApp.admin_attribute.read(attribute_id, function(response) {
				$('#attribute-id').val(response.data.attribute_id);
				$('#attribute-label').val(response.data.label);
				$('#attribute-name').val(response.data.name);
				$('#attribute-description').val(response.data.description);

				$('#modalNewAttribute').modal('show');
			});
    	});
	};

	var attributeSave = function() {
		$('#attribute-save-btn').click(function(e) {
			e.preventDefault();
			var attribute = {};
			attribute.attribute_id = $('#attribute-id').val();
			attribute.name = $('#attribute-name').val();
			attribute.label = $('#attribute-label').val();
			attribute.description = $('#attribute-description').val();
			BlueFissionApp.admin_attribute.save(attribute, function(response) {
        		$('#modalNewAttribute').modal('hide');
				toastr.success("Attribute has been saved");
				loadAttributeList();
			});
		});
	};

	// --
	// Operators

	var loadOperatorList = function() {
		BlueFissionApp.admin_operator.list(function(response) {
			var $list = $('#operator-id');
			var $list2 = $('#operator');
			var template = new Template('#operator-list-item');
			$list.find('option').remove();
			$list2.find('option').remove();
			for ( var x = 0; x < response.list.length; x++ ) {
				$list.append(template.render(response.list[x]));
				$list2.append(template.render(response.list[x]));
			}
		});
	};

	var operatorNew = function() {
		$('#operator-new-btn').click(function(e) {
			e.preventDefault();
			$('#operator-id').val("");
			$('#operator-name').val("");
			$('#operator-label').val("");
			$('#operator-description').val("");

			$('#modalNewOperator').modal('show');
		});
	};
	
	var operatorEdit = function() {
		$('#operator-edit-btn').click(function(e) {
			e.preventDefault();
			var operator_id = $('#operator').val();
			BlueFissionApp.admin_operator.read(operator_id, function(response) {
				$('#operator-id').val(response.data.operator_id);
				$('#operator-label').val(response.data.label);
				$('#operator-name').val(response.data.name);
				$('#operator-description').val(response.data.description);

				$('#modalNewOperator').modal('show');
			});
    	});
	};

	var operatorSave = function() {
		$('#operator-save-btn').click(function(e) {
			e.preventDefault();
			var operator = {};
			operator.operator_id = $('#operator-id').val();
			operator.name = $('#operator-name').val();
			operator.label = $('#operator-label').val();
			operator.description = $('#operator-description').val();
			BlueFissionApp.admin_operator.save(operator, function(response) {
        		$('#modalNewOperator').modal('hide');
				toastr.success("Operator has been saved");
				loadOperatorList();
			});
		});
	};


	// --
	// Unit Types

	var loadUnitTypeList = function() {
		BlueFissionApp.admin_unit_type.list(function(response) {
			var $list = $('#kpi-unit-type-id');
			var $list2 = $('#unit-type');
			var template = new Template('#unit-type-list-item');
			$list.find('option').remove();
			$list2.find('option').remove();
			for ( var x = 0; x < response.list.length; x++ ) {
				$list.append(template.render(response.list[x]));
				$list2.append(template.render(response.list[x]));
			}
		});
	};

	var unitTypeNew = function() {
		$('#unit-type-new-btn').click(function(e) {
			e.preventDefault();
			$('#unit-type-id').val("");
			$('#unit-type-name').val("");
			$('#unit-type-label').val("");
			$('#unit-type-description').val("");

			$('#modalNewUnitType').modal('show');
		});
	};
	
	var unitTypeEdit = function() {
		$('#unit-type-edit-btn').click(function(e) {
			e.preventDefault();
			var unit_type_id = $('#unit-type').val();
			BlueFissionApp.admin_unit_type.read(unit_type_id, function(response) {
				$('#unit-type-id').val(response.data.unit_type_id);
				$('#unit-type-label').val(response.data.label);
				$('#unit-type-name').val(response.data.name);
				$('#unit-type-description').val(response.data.description);

				$('#modalNewUnitType').modal('show');
			});
    	});
	};

	var unitTypeSave = function() {
		$('#unit-type-save-btn').click(function(e) {
			e.preventDefault();
			var unit_type = {};
			unit_type.unit_type_id = $('#unit-type-id').val();
			unit_type.name = $('#unit-type-name').val();
			unit_type.label = $('#unit-type-label').val();
			unit_type.description = $('#unit-type-description').val();
			BlueFissionApp.admin_unit_type.save(unit_type, function(response) {
        		$('#modalNewUnitType').modal('hide');
				toastr.success("Unit Type has been saved");
				loadUnitTypeList();
			});
		});
	};


	return {
        //main function to initiate the module
        init: function () {

        	// loadKpiTypeList();
        	kpiTypeNew();
        	kpiTypeEdit();
        	kpiTypeSave();

        	loadKpiCategoryList();
        	kpiCategoryNew();
        	kpiCategoryEdit();
        	kpiCategorySave();

        	loadAttributeList();
        	attributeNew();
        	attributeEdit();
        	attributeSave();

        	loadOperatorList();
        	operatorNew();
        	operatorEdit();
        	operatorSave();

        	loadUnitTypeList();
        	unitTypeNew();
        	unitTypeEdit();
        	unitTypeSave();
        }
    };
}();

jQuery(document).ready(function() {
    ModuleInitiativeMetric.init();
});