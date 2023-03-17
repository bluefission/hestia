<?php

return [

	// Class alias for scope and extensibility 
	'aliases'=>[
		'\App'			=>'\BlueFission\Framework\Engine'
	],

	// Extensions to the application functionality
	'extensions'		=> [
		'App\Registration\AppRegistration',
	],

	// Gateways for processing requests
	'gateways'=> [
		'auth'			=>'\BlueFission\Framework\Gateway\AuthenticationGateway',
		'cache'			=>'\BlueFission\Framework\Gateway\CacheGateway',
		'csrf'			=>'\BlueFission\Framework\Gateway\CsrfGateway',
		'nocsrf'		=>'\BlueFission\Framework\Gateway\NoCsrfGateway',
		'admin:auth'	=>'\App\Business\Gateways\AdminAuthenticationGateway',
	],
];