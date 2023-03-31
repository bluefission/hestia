<?php

namespace App\Business\Managers;

use BlueFission\Services\Service;
use BlueFission\Services\Authenticator;
use BlueFission\Data\Storage\Storage;
use App\Domain\Communication\Communication;
use App\Domain\Communication\Repositories\ICommunicationRepository;
use App\Domain\Communication\Repositories\CommunicationRepositorySql;
use App\Domain\Communication\Queries\IUndeliveredCommunicationsQuery;
use Closure;

class CommunicationManager extends Service
{
    protected $repo;
    protected $undeliveredQuery;
    protected $drivers;

    public function __construct( ICommunicationRepository $repo, IUndeliveredCommunicationsQuery $undeliveredQuery, $driverConfigurations = [])
    {
        $this->repo = $repo;
        $this->undeliveredQuery = $undeliveredQuery;
        $this->drivers = [];

        foreach ($driverConfigurations as $driverClass => $condition) {
            $this->registerDriver($driverClass, $condition);
        }

        parent::__construct();
    }

    public function registerDriver(string $driverClass, Closure $condition): void
    {
        $this->drivers[$driverClass] = $condition;
    }

    // Basic CRUD methods for the communications table.
    public function create(Communication $message)
    {
        $this->repo->save($message);
    }

    public function read($communication_id)
    {
        return $this->repo->find($communication_id);
    }

    public function update(Communication $message)
    {
        if ($message->communication_id) {
            $this->repo->save($message);
        }
    }

    public function delete($communication_id)
    {
        $this->repo->remove($communication_id);
    }

    public function queueMessage(Communication $message)
    {
        // If no model is configured, directly route the message
        // if (!MysqlLink::tableExists('communications') || $message->isSecret()) {
        if ($this->repo === null || $message->isSecret()) {
            $this->routeMessage($message);
            return;
        }

        // Otherwise, store the message in the queue
        $this->repo->save($message);
    }

    public function processUndeliveredMessages()
    {
        // If no model is configured, return immediately
        if ($this->repo === null) {
            return;
        }

        // Process undelivered messages
        $messages = $this->getUndeliveredMessages();
        foreach ($messages as $message) {
            $this->routeMessage($message);
        }
    }

    protected function getUndeliveredMessages()
    {
        $messages = $this->undeliveredQuery->fetch();
        
        return $messages;
    }

    protected function routeMessage(Communication $message)
    {
        // Choose the appropriate driver based on the message type
        $driver = $this->resolveDriver($message);
        if ($driver) {
            // Deliver the message using the chosen driver
            $driver->send($message);

            // Update the message status to 'delivered'
            $message->status = Communication::DELIVERED;
            $this->update($message);
        }
    }

    protected function resolveDriver(Communication $message)
	{
	    $driverClass = null;

	    foreach ($this->drivers as $class => $condition) {
	        if ($condition($message)) {
	            $driverClass = $class;
	            break;
	        }
	    }

	    if ($driverClass !== null) {
	    	return new $driverClass;
	    }

	    return null;
	}


    public static function send(string $content, string $channel = null, int $userId = null, bool $prompt = false, array $attachments = [], array $parameters = [], bool $isSecret = false)
    {
        // Get the default values for sender and recipient
        $senderId = 0; // Assuming 0 is the system ID
        $auth = new Authenticator(new Storage);
        $recipientId = $auth->id ?? 0; // Assuming the currently logged-in user or anonymous user if not logged in

        if ($userId) {
            // If user_id is passed, it's a message from the user to the system
            $senderId = $userId;
            $recipientId = 0;
        }

        // Create and send the message
        $message = new Communication();
        $message->user_id = $senderId;
        $message->channel = $channel;
	    $message->recipient_id = $recipientId;
	    $message->content = $content;
	    $message->communication_channel_id = $channel;

        if (!$isSecret) {
            // $repo = new CommunicationRepositorySql;
            $repo = \App::makeInstance(CommunicationRepositorySql::class);
            // $model = new CommunicationModel();

            $repo->save($message, $attachments, $parameters);
            $message->message_id = $repo->lastInsertId();
        }
        // If the message is secret, bypass saving and send directly
        $manager = \App::instance()->service('communication');
        $manager->routeMessage($message);

        return $message;
    }
}