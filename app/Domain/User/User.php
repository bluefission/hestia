<?php
namespace App\Domain\User;
use BlueFission\Framework\ValueObject;

class User extends ValueObject
{
	public $user_id;
	public $realname;
	public $displayname;
}