<?php
use App\Business\Drivers\HTTPCommunicationDriver;
use App\Business\Drivers\BotManCommunicationDriver;
use BlueFission\BlueCore\Domain\Repositories\CommunicationChannelRepositorySql;
use BlueFission\BlueCore\Domain\Repositories\CommunicationTypeRepositorySql;
use BlueFission\BlueCore\Domain\Communication;

return [
	'drivers' => [
	    HTTPCommunicationDriver::class => function (Communication $communication) {
	        return $communication->channel === 'http';
	    },
	    BotManCommunicationDriver::class => function (Communication $communication) {
	        return $communication->channel === 'botman';
	    },
	]
];