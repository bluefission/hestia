<?php
use BlueFission\BlueCore\Datasource\Generator;
use BlueFission\Str;

use BlueFission\BlueCore\Domain\User\Models\UserModel;
use BlueFission\BlueCore\Domain\User\Models\CredentialModel;
use BlueFission\BlueCore\Domain\User\Models\CredentialStatusModel;
use BlueFission\BlueCore\Domain\User\CredentialStatus;

class InitialUserData extends Generator
{
	public function populate() {
		$statuses = [
			'Unverified'=>CredentialStatus::UNVERIFIED,
			'Verified'=>CredentialStatus::VERIFIED,
			'Expired'=>CredentialStatus::EXPIRED,
			'Invalid'=>CredentialStatus::INVALID,
		];

		$status = new CredentialStatusModel();
		foreach ( $statuses as $label=>$name ) {
			$status->clear();
			$status->name = $name; //strtolower($label);
			$status->label = $label;
			$status->write();

			echo "Creating status: {$status->label} ";
			echo $status->status()."\n";
		}

		$status->clear();
		$status->name = CredentialStatus::VERIFIED;
		$status->read();

		$password = Str::rand(null, 16, true);
		if ( defined('STDIN') ) {
			$password = prompt_silent("Enter an admin password: ");
		}

		$user = new UserModel();
		$credential = new CredentialModel();

		$user->realname = 'System Admin';
		$user->displayname = 'Admin';
		$user->write();
		echo "Creating Admin user: {$user->displayname} ";
		echo $user->status()."\n";
		$user->read();

		$credential->username = 'admin';
		$credential->password = $password;
		$credential->is_primary = 1;
		$credential->credential_status_id = $status->id();
		$credential->password = password_hash($credential->password, PASSWORD_DEFAULT);
		$credential->user_id = $user->id();

		$credential->write();
		echo "Saving credentials for {$credential->username} ";
		echo $credential->status()."\n";

		echo "Complete.\n";
	}
}