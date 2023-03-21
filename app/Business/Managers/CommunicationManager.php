<?php

namespace App\Domain\Managers;

use BlueFission\Services\Service;
use BlueFission\Data\Storage\Storage;
use App\Domain\Communication\Models\CommunicationModel;
use App\Domain\Communication\Communication;
use BlueFission\Data\Storage\Storage;
use BlueFission\Services\Authenticator;
use Closure;

class CommunicationManager extends Service
{
    protected $storage;
    protected $drivers;

    public function __construct(array $driverConfigurations = [])
    {
        $this->storage = new CommunicationModel();
        $storage->clear();
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
        $this->storage->assign($message);
        $this->storage->write();
    }

    public function read($communication_id)
    {
    	$this->storage->assign(['communication_id' => $communication_id]);
        return $this->storage->read();
    }

    public function update(Communication $message)
    {
    	$this->storage->assign($message);
        $this->storage->update();
    }

    public function delete($communication_id)
    {
    	$this->storage->assign(['communication_id' => $communication_id]);
        $this->storage->delete();
    }

    public function queueMessage(Communication $message)
    {
        // If no storage is configured, directly route the message
        if ($this->storage === null) {
            $this->routeMessage($message);
            return;
        }

        // Otherwise, store the message in the queue
        $this->storage->assign($message)
        $this->storage->write();
    }

    public function processUndeliveredMessages()
    {
        // If no storage is configured, return immediately
        if ($this->storage === null) {
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
        $this->storage->assign(['status' => Communication::SENT]);
        $messages = $this->storage->getRecordSet();
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


    public static function send(string $content, string $channel = null, int $userId = null, array $attachments = [], array $parameters = [], bool $isSecret = false)
    {
        // Get the default values for sender and recipient
        $senderId = 0; // Assuming 0 is the system ID
        $auth = new Authenticator($storage);
        $recipientId = $auth->userID() ?? 0; // Assuming the currently logged-in user or anonymous user if not logged in

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

	        $model->clear();
	        $model->assign($message);
	        $model->addAttachments($attachments);
	        $model->addParameters($parameters);

            $model->write();
            $model->read();
            $message->message_id = $model->id();
        }
        // If the message is secret, bypass saving and send directly
        $manager = \App::instance()->service('communication');
        $manager->routeMessage($message);

        return $message;
    }
}