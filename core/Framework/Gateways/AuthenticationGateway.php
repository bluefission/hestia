<?php
namespace BlueFission\Framework\Gateways;

use BlueFission\Services\Gateway;
use BlueFission\Services\Request;
use BlueFission\Services\Authenticator;

class AuthenticationGateway extends Gateway {

	public function __construct() {}
	
	public function process( Request $request, &$arguments )
	{
		$auth = new Authenticator();

		if ( !$auth->isAuthenticated ) {
			header('Location: /');
		}
	}
}