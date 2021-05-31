<?php 
namespace BlueFission\Framework\Model;

use BlueFission\Data\IData;
use BlueFission\Data\Storage\Storage;
use BlueFission\DevString;
use BlueFission\DevObject;

class BaseModel extends DevObject implements IData {

	protected $_timestampFormat = 'Y-m-d G:i:s';
	protected $_dataObject;
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
		if (!$this->id) {
			$this->created = date($this->_timestampFormat);
		}
		$this->updated = date($this->_timestampFormat);
	}

	protected function generateUuid()
	{
		$this->id = DevString::uuid4();
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
		return $this->_dataObject->read();
	}
	public function write() {
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

	public function data() 
	{
		return $this->_dataObject->data();
	}

	public function config( $config = null, $value = null ) {}

	public function response()
	{
		$response = [
			'data' => $this->data(),
			'status'=> $this->status(),
		];

		if ( env('DEBUG') && method_exists ( $this->_dataObject, 'query' )) {
			$response['info'] = $this->_dataObject->query();
		}
		return $response;
	}
}