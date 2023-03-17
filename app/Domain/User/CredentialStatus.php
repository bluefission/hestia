<?php
namespace App\Domain\User;

class CredentialStatus {
	const UNVERIFIED = 'credential_status_unverified';
	const VERIFIED = 'credential_status_verified';
	const EXPIRED = 'credential_status_expired';
	const INVALID = 'credential_status_invalid';

	public $credential_status_id;
	public $name;
	public $label;
}