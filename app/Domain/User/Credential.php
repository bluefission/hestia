<?php
namespace App\Domain\User;
use BlueFission\BlueCore\ValueObject;

class Credential extends ValueObject {
	public $credential_id;
	public $username;
	public $password;
	public $credential_status_id;
	public $is_primary;
}