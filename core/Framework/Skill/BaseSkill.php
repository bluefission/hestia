<?php
namespace BlueFission\Framework\Skill;

class BaseSkill {
	protected $_name = 'Base Skill';
	protected $_command = '';

	public function __construct( $name = '', $command = '' ) {
		$this->_name = $name;
		$this->_command = $command;
	}

	public function name() {
		return $this->_name;
	}

	public function command() {
		return $this->_command;
	}

	public function execute( $prompt ) { }

	public function response(): string 
	{
		return '';
	}
}