<?php
namespace App\Domain\Initiative\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class AttributeModel extends Model {
	// User Attributes
	const DISPOSITION = "Disposition User Attribute";
	const EXPRESSION = "Expression User Attribute";
	const ARCHETYPE = "Archetypal Job User Attribute";
	const DOMAIN = "Domain User Attribute";
	const LEVEL = "Level User Attribute";
	const EXPERIENCE = "Experience User Attribute";
	const SCOPE = "Scope User Attribute";
	const EFFECTIVENESS = "Effectiveness User Attribute";

	// Spatial Attributes
	const WORLD = "World Spatial Attribute";
	const CONTINENT = "Continent Spatial Attribute";
	const NATION = "Nation Spatial Attribute";
	const STATE = "State Spatial Attribute";
	const COUNTY = "County Spatial Attribute";
	const CITY = "City Spatial Attribute";
	const AREA = "Area Spatial Attribute";
	const LATITUDE = "Latitude Spatial Attribute";
	const LONGITUDE = "Longitude Spatial Attribute";

	// Location Attributes
	const POSTCODE = "Postcode Location Attribute";
	const ADDRESS = "Address Location Attribute";
	
	// Temporal Attributes
	const CENTURY = "Century Temporal Attribute";
	const DECADE = "Decade Temporal Attribute";
	const YEAR = "Year Temporal Attribute";
	const SEASON = "Season Temporal Attribute";
	const MONTH = "Month Temporal Attribute";
	const WEEK = "Week Temporal Attribute";
	const DATE = "Date Temporal Attribute";
	const PERIOD = "Period Temporal Attribute";
	const HOUR = "Hour Temporal Attribute";

	// Event Attributes
	const EVENTNAME = "Event Name Event Attribute";
	const HOLIDAY = "Holiday Event Attribute";
	const MOONPHASE = "Moon Phase Event Attribute";

	protected $_table = 'attributes';
	protected $_fields = [
		'attribute_id',
		'name',
		'label',
		'description',
	];
}