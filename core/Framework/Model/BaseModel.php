<?php 
namespace BlueFission\Framework\Model;

use BlueFission\Data\IData;
use BlueFission\Data\Storage\Storage;
use BlueFission\DevString;
use BlueFission\DevArray;
use BlueFission\DevObject;
use BlueFission\Behavioral\Behaviors\State;
use BlueFission\Framework\Engine as App;
use JsonSerializable;

class BaseModel extends DevObject implements IData, JsonSerializable {

	protected $_timestampFormat = 'Y-m-d G:i:s';
	protected $_dataObject;
	protected $_related = [];
	protected $_relationships = [];
	protected $_idField = 'id';

	public function __construct( )
	{
		// Not using dependency injection because
		// 	These objects are necessarily coupled.
		// This is essentially just a container for a DB object.
		// We'll just extend new classes for new storage types;
		$this->_dataObject = new Storage();
	}

	protected function generateTimestamp()
	{
		$id = $this->_idField;
		if (!$this->_dataObject->$id) {
			$this->created = date($this->_timestampFormat);
		}
		$this->updated = date($this->_timestampFormat);
	}

	protected function generateUuid()
	{
		$id = $this->_idField;
		$this->{$id} = DevString::uuid4();
	}

	public function field($field, $value = null)
	{
		return $this->_dataObject->field($field, $value);
	}

	public function clear()
	{
		$this->_dataObject->clear();
	}

	public function read() {
		$this->_dataObject->activate();
		$this->_dataObject->read();
		$this->loadRelationships();
	}
	public function write() {
		$this->generateTimestamp();
		$this->_dataObject->activate();
		return $this->_dataObject->write();
	}
	public function delete() { 
		$this->_dataObject->activate();
		return $this->_dataObject->delete();
	}
	public function contents() { 
		return $this->_dataObject->contents();
	}

	public function status( $message = null ) {
		return $this->_dataObject->status();
	}

	public function children() {
		return isset($this->_relationships['descendents']) ? $this->{$this->_relationships['descendents'][0]}() : [];
	}

	public function id() {
		return $this->data()[$this->_idField];
	}

	public function data() 
	{
		return $this->_dataObject->data();
	}

	public function config( $config = null, $value = null ) {}

	public function assign( $data )
	{
		if ( is_object( $data ) || DevArray::isAssoc( $data ) ) {
			foreach ( $data as $a=>$b ) {
				$this->field($a, $b);
			}
		}
		else
			throw new \InvalidArgumentException( "Can't import from variable type " . gettype($data) );
	}

	protected function ancestor($modelClass, $from_id_name, $on_id_name = '')
	{
		$model = \App::makeInstance($modelClass);
		$id = $on_id_name ?? $from_id_name;
		$model->$id = $this->$from_id_name;
		$model->read();
		// $data = $model->data();
		return $model;
	}

	protected function descendent($modelClass, $on_id_name, $from_id_name = '')
	{
		$model = \App::makeInstance($modelClass);
		$id = $from_id_name ?? $on_id_name;
		$model->$on_id_name = $this->$id;
		$model->read();
		// $data = $model->data();
		return $model;
	}

	protected function descendents($modelClass, $on_id_name, $from_id_name = '')
	{
		// $refClass = new \ReflectionClass($modelClass);
		$model = \App::makeInstance($modelClass);
		$id = $from_id_name ?? $on_id_name;
		$model->$on_id_name = $this->$id;
		$model->read();
		$data = $model->result()->toArray();
		$result = [];
		foreach ( $data as $row ) {
			$model->clear();
			$model->assign($row);
			$model->read();
			$result[] = clone $model;
		}
		return $result;
	}

	protected function addRelationship( $type, $name )
	{
		$this->_relationships[$type][] = $name;
	}

	protected function loadRelationships()
	{
		foreach ($this->_related as $relation)
		{
			if ( method_exists($this, $relation) ) {
				$this->addRelationship('descendents', $relation);
				if ( method_exists ( $this->_dataObject, 'perform' )) {
					$this->_dataObject->perform(State::DRAFT);
				}
				// $this->{$relation} = $this->{$relation}();
				$this->field($relation, $this->{$relation}());
				if ( method_exists ( $this->_dataObject, 'halt' )) {
					$this->_dataObject->halt(State::DRAFT);
				}
			}
		}
	}

	public function response()
	{
		$response = [
			'id' => $this->data()[$this->_idField],
			'children' => isset($this->_relationships['descendents']) ? $this->{$this->_relationships['descendents'][0]}() : [],
			'list' => $this->contents(),
			'data' => $this->data(),
			'status'=> $this->status(),
		];

		if ( env('DEBUG') && method_exists ( $this->_dataObject, 'query' )) {
			$response['info'] = $this->_dataObject->query();
		}
		return $response;
	}

	public function jsonSerialize() {
        return $this->data();
    }

	public function __clone()
	{
		$this->_dataObject = clone $this->_dataObject;
	}
}