<?php
namespace BlueFission\Framework;

class ValueObject implements IValueObject {

	public function assign($values) {
		foreach ( get_object_vars($this) as $property=>$value ) {
			$this->$property = $values->$property ?? ( $values[$property] ?? $value );
		}
	}
}