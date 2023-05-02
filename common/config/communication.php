<?php
use App\Business\Drivers\HTTPCommunicationDriver;
use App\Business\Drivers\BotManCommunicationDriver;
use App\Domain\Communication\Repositories\CommunicationChannelRepositorySql;
use App\Domain\Communication\Repositories\CommunicationTypeRepositorySql;
use App\Domain\Communication\Communication;

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