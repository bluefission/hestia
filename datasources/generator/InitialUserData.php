<?php
use BlueFission\Framework\Datasource\Generator;
use BlueFission\DevString;

use App\Domain\User\Models\UserModel;
use App\Domain\User\Models\CredentialModel;
use App\Domain\User\Models\CredentialStatusModel;
use App\Domain\User\CredentialStatus;

class InitialUserData extends Generator
{
	public function populate() {
		$statuses = [
			'Unverified'=>CredentialStatus::UNVERIFIED,
			'Verfied'=>CredentialStatus::VERIFIED,
			'Expired'=>CredentialStatus::EXPIRED,
			'Invalid'=>CredentialStatus::INVALID,
		];

		$status = new CredentialStatusModel();
		foreach ( $statuses as $label=>$name ) {
			$status->clear();
			$status->name = $name; //strtolower($label);
			$status->label = $label;
			$status->write();
		}

		$status->clear();
		$status->name = CredentialStatus::VERIFIED;
		$status->read();

		$password = DevString::random(null, 16, true);
		if ( defined('STDIN') ) {
			$password = readline("Enter an admin password: ");
		}

		$user = new UserModel();
		$credential = new CredentialModel();

		$user->realname = 'System Admin';
		$user->displayname = 'Admin';
		$user->write();
		$user->read();

		$credential->username = 'admin';
		$credential->password = $password;
		$credential->is_primary = 1;
		$credential->credential_status_id = $status->id();
		$credential->password = password_hash($credential->password, PASSWORD_DEFAULT);
		$credential->user_id = $user->id();

		$credential->write();
	}
}