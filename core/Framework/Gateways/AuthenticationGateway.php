<?php
namespace BlueFission\Framework\Gateways;

class AuthenticationGateway extends Gateway {
	
	public function process( Request $request, &$arguments )
	{
		die(var_dump($arguments));
	}
}