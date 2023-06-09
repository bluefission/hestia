<?php
namespace App\Domain\Initiative\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class OperatorModel extends Model {
	const LESS_THAN = "Less Than Operator";
    const GREATER_THAN = "Greater Than Operator";
    const EQUAL_TO = "Equal To Operator";
    const LESS_THAN_OR_EQUAL_TO = "Less Than or Equal To Operator";
    const GREATER_THAN_OR_EQUAL_TO = "Greater Than or Equal To Operator";
    const NOT = "Not Operator";
    const LIKE = "Like Operator"; 

    const WITHIN_10_UNITS = "Within 10 Units Operator"; 
    const WITHIN_100_UNITS = "Within 100 Units Operator"; 
    const WITHIN_1000_UNITS = "Within 1000 Units Operator"; 
    const WITHIN_10_PERCENT = "Within 10 Percent Operator"; 
    const WITHIN_50_PERCENT = "Within 50 Percent Operator"; 

	protected $_table = 'operators';
	protected $_fields = [
		'operator_id',
		'name',
		'label',
		'description',
	];
}