<?php
namespace App\Domain\Initiative\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class InitiativeTypeModel extends Model {

	const MISSION = "Mission Initiative Type"; // Game's main story thread
	const QUEST = "Quest Initiative Type"; // Exploratory activities
	const PROJECT = "Project Initiative Type"; // User created requests
	const GOAL = "Goal Initiative Type"; // Personal initiatives
	const TASK = "Task Initiative Type"; // One-off individual actions
	const ACHIEVEMENT = "Achievement Initiative Type"; // Passive objectives

	protected $_table = 'initiative_types';
	protected $_fields = [
		'initiative_type_id',
		'name',
		'label',
		'description',
	];
}