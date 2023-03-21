<?php
use App\Business\Drivers\HTTPCommunicationDriver;
use App\Business\Drivers\BotManCommunicationDriver;

return [
	'drivers' => [
	    HTTPCommunicationDriver::class => function (Communication $message) {
	        return $message->channel === 'ajax';
	    },
	    BotManCommunicationDriver::class => function (Communication $message) {
	        return $message->channel === 'botman';
	    },
	]
];