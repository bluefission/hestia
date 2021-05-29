<?php
namespace BlueFission\Framework\Gateways;

use BlueFission\Services\Gateway;
use BlueFission\Services\Request;
use BlueFission\Data\Storage\Storage;
use BlueFission\Services\Authenticator;

class AuthenticationGateway extends Gateway {

	public $_redirectUri = '/login';

	public function __construct() {}
	
	public function process( Request $request, &$arguments )
	{
		$auth = new Authenticator( new Storage );

		if ( $auth->isAuthenticated ) {
			$auth->setSession();
		} else {
			// $auth->destroySession();
			// $this->redirect();
		}
	}

	public function redirect()
	{
		header('Location: '.$this->_redirectUri);
	}
}