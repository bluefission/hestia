<?php
namespace App\Domain\User;
use BlueFission\BlueCore\ValueObject;

class CredentialStatus extends ValueObject {
	const UNVERIFIED = 'credential_status_unverified';
	const VERIFIED = 'credential_status_verified';
	const EXPIRED = 'credential_status_expired';
	const INVALID = 'credential_status_invalid';

	public $credential_status_id;
	public $name;
	public $label;
}