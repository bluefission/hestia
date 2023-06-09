<?php
namespace App\Domain\Initiative\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class KpiCategoryModel extends Model {
	//
	// https://www.brightgauge.com/blog/quick-guide-to-11-types-of-kpis
    // Indicator Types: 
    // - Qualitative
	// - Quantitative
	// - Leading
	// - Lagging
	// - Input
	// - Process
	// - Output 
	// - Practical
	// - Directional
	// - Actionable
	// - Financial
	
    const QUALITATIVE = "Qualitative KPI Category";
    const CONTINUOUS = "Continuous Quantitative KPI Category";
    const DISCRETE = "Discrete Quantitative KPI Category";
    const LEADING = "Leading KPI Category";
    const LAGGING = "Lagging KPI Category";
    const INPUT = "Input KPI Category";
    const PROCESS = "Process KPI Category";
    const OUTPUT = "Output KPI Category";
    const PRACTICAL = "Practical KPI Category";
    const DIRECTIONAL = "Directional KPI Category";
    const ACTIONABLE = "Actionable KPI Category";
    const FINANCIAL = "Financial KPI Category";
    
	protected $_table = 'kpi_categories';
	protected $_fields = [
		'kpi_category_id',
		'name',
		'label',
		'description',
	];
}