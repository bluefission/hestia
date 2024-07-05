<?php
namespace App\Business\Gateways;

use BlueFission\BlueCore\Gateway\AuthenticationGateway;

class AdminAuthenticationGateway extends AuthenticationGateway {

	public $_redirectUri = '/admin';
}