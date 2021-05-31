<?php
namespace App\Business\Gateways;

use BlueFission\Framework\Gateway\AuthenticationGateway;

class AdminAuthenticationGateway extends AuthenticationGateway {

	public $_redirectUri = '/admin';
}