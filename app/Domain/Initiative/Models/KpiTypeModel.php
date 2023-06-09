<?php
namespace App\Domain\Initiative\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class KpiTypeModel extends Model {
	// https://www.clearpointstrategy.com/18-key-performance-indicators/
    // https://www.scoro.com/blog/key-performance-indicators-examples/
    // https://onstrategyhq.com/resources/27-examples-of-key-performance-indicators/
    
    protected $_table = 'kpi_types';
	protected $_fields = [
		'kpi_type_id',
		'kpi_category_id',
		'unit_type_id',
		'name',
		'label',
		'description',
	];
}