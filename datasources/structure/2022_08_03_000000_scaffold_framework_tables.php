<?php

use BlueFission\Framework\Datasource\Delta;
// use BlueFission\Data\Storage\Structure\Structure;
use BlueFission\Data\Storage\Structure\MysqlStructure as Structure;
use BlueFission\Data\Storage\Structure\MysqlScaffold as Scaffold;

class ScaffoldFrameworkTables extends Delta
{
	public function change() {
		Scaffold::create('users', function( Structure $entity ) {
			$entity->incrementer('user_id');
			$entity->text('realname');
			$entity->text('displayname')->null();
			$entity->timestamps();
			$entity->comment("The table holding all of the application's user identites.");
		});

		Scaffold::create('credential_statuses', function( Structure $entity ) {
			$entity->incrementer('credential_status_id');
			$entity->text('name');
			$entity->text('label')->null();
			$entity->timestamps();
			$entity->comment("The status for credentials (active, verified, disabled, etc).");
		});

		Scaffold::create('credentials', function( Structure $entity ) {
			$entity->incrementer('credential_id');
			$entity->text('username')
				->unique();
			$entity->text('password');
			$entity->numeric('credential_status_id')
				->foreign('credential_statuses', 'credential_status_id');
			$entity->numeric('is_primary', 1)->null;
			$entity->timestamps();
			$entity->comment("The table holding user credentials for password authentication.");
		});

		Scaffold::create('login_attempts', function( Structure $entity ) {
			$entity->incrementer('login_attempt_id');
			$entity->text('ip_address');
			$entity->text('username')->null();
			$entity->numeric('attempts');
			$entity->date('last_attempt');
			$entity->timestamps();
			$entity->comment("Log for the attempted logins for users and credentials.");
		});
	}

	public function revert() {
		Scaffold::delete('login_attempts');
		Scaffold::delete('credentials');
		Scaffold::delete('credential_statuses');
		Scaffold::delete('users');
	}
}