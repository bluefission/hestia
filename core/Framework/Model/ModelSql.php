<?php
namespace BlueFission\Framework\Model;

use BlueFission\Framework\Model\BaseModel;
use BlueFission\Data\Storage\MysqlBulk;

class ModelSql extends BaseModel {

	protected $_table = '';
	protected $_fields = [];

	protected $_autojoin = true;
	protected $_ignore_null = true;
	protected $_save_related_tables = false;

	public function __construct( )
	{
		$this->_type = get_class($this);
		$this->_dataObject = new MysqlBulk([
			'name'=>$this->_table,
			'fields'=>$this->_fields,
			'auto_join'=>$this->_autojoin,
			'ignore_null'=>$this->_ignore_null,
			'save_related_tables'=>$this->_save_related_tables,
		]);
		$this->_dataObject->activate();
		$this->init();
		$this->_idField = $this->_dataObject->primary();
	}

	protected function init()
	{
		// With inheritance, configure the model here 
	}

	public function field($field, $value = null)
	{
		if ( array_key_exists($field, $this->_dataObject->_data) || in_array($field, $this->_fields) ) {
			return parent::field($field, $value);
		}

		return null;
	}

	public function write()
	{
		$force_created_timestamp = false;
		$force_updated_timestamp = false;
		$id = $this->_idField;
		
		if (!in_array('created', $this->_fields) && !$this->_save_related_tables && !$this->_dataObject->$id) {
			$this->_fields[] = 'created';
			$force_created_timestamp = true;
		}
		if (!in_array('updated', $this->_fields) && !$this->_save_related_tables) {
			$this->_fields[] = 'updated';
			$force_updated_timestamp = true;
		}
		$this->_dataObject->config('fields', $this->_fields);
		// Do the work
		$result = parent::write();
		if ($force_created_timestamp) {
			if (($key = array_search("created", $this->_fields)) !== false) {
			    unset($this->_fields[$key]);
			}
		}
		if ($force_updated_timestamp) {
			if (($key = array_search("updated", $this->_fields)) !== false) {
			    unset($this->_fields[$key]);
			}
		}
		$this->_dataObject->config('fields', $this->_fields);

		return $result;
	}

	public function result()
	{
		return $this->_dataObject->result();
	}

	public function query()
	{
		return $this->_dataObject->query();
	}

	protected function parent($modelClass, $from_id_name, $on_id_name = '')
	{
		$refClass = new \ReflectionClass($modelClass);
		$model = $refClass->newInstance();
		$id = $on_id_name ?? $from_id_name;
		$model->$id = $this->$from_id_name;
		$model->read();
		// $data = $model->data();
		return $model;
	}

	protected function child($modelClass, $on_id_name, $from_id_name = '')
	{
		$refClass = new \ReflectionClass($modelClass);
		$model = $refClass->newInstance();
		$id = $from_id_name ?? $on_id_name;
		$model->$on_id_name = $this->$id;
		$model->read();
		// $data = $model->data();
		return $model;
	}

	protected function children($modelClass, $on_id_name, $from_id_name = '')
	{
		$refClass = new \ReflectionClass($modelClass);
		$model = $refClass->newInstance();
		$id = $from_id_name ?? $on_id_name;
		$model->$on_id_name = $this->$id;
		$model->read();
		// $data = $model->result();
		return $model;
	}
}