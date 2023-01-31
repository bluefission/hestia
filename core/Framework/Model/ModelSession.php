<?php
namespace BlueFission\Framework\Model;

use BlueFission\Framework\Model\BaseModel;
use BlueFission\Data\Storage\Session;

class ModelSession extends BaseModel {

	protected $_domain = '';
	protected $_name = '';
	protected $_fields = [];

	public function __construct()
	{
		$this->_type = get_class($this);
		$this->_dataObject = new Session([
			'location'=>$this->_domain,
			'name'=>$this->_name,
			'fields'=>$this->_fields
		]);
		$this->_dataObject->activate();
		$this->init();
	}

	protected function init()
	{
		// With inheritance, configure the model here 
		foreach ($this->_fields as $field) {
			$this->_dataObject->$field = null;
		}
	}

	public function write()
	{
		$id = $this->_idField;
		if ( !$this->$id ){
			parent::generateUuid();
		}
		parent::write();
	}
}