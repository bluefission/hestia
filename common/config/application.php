<?php

return [

	// Class alias for scope and extensibility 
	'aliases'=>[
		'\App'=>'\BlueFission\Framework\Engine'
	],

	// Extensions to the application functionality
	'extensions'=> [
		'App\Registration\AppRegistration',
	],

	// Gateways for processing requests
	'gateways'=> [
		'auth'=>'\BlueFission\Framework\Gateways\AuthenticationGateway'
	],
];