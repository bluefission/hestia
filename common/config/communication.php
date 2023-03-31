<?php
use App\Business\Drivers\HTTPCommunicationDriver;
use App\Business\Drivers\BotManCommunicationDriver;
use App\Domain\Communication\Communication;

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