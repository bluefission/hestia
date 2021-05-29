<?php
namespace App\Business\Gateways;

use BlueFission\Framework\Gateways\AuthenticationGateway;

class AdminAuthenticationGateway extends AuthenticationGateway {

	public $_redirectUri = '/admin';
}