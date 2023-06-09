<?php
// src/App/Terminal.php
namespace App;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use BlueFission\System\System;
use React\EventLoop\LoopInterface;

class Terminal implements MessageComponentInterface {
    protected $clients;
    protected $system;
    protected $processes;
    protected $loop;

    public function __construct(LoopInterface $loop) {
        $this->loop = $loop;
        $this->clients = new \SplObjectStorage;
        $this->system = new System();
        $this->processes = [];
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        $this->sendWelcomeMessage($conn);

        $cmd = 'php terminal.php cmd t';

        $resourceId = $conn->resourceId;
        $processId = $this->system->start($cmd);
        $this->processes[$resourceId] = $processId;

        // Immediately read any available output and send it to the client.
        $output = $this->system->readAvailableOutput($processId);
        if ($output !== '') {
            $conn->send($output);
        }

        // Add a periodic timer to check for new output and send it to the client.
        // $this->loop = $conn->httpRequest->getAttribute('loop');
        $this->loop->addPeriodicTimer(0.1, function () use ($conn, $processId) {
            while (true) {
                $output = $this->system->readAvailableOutput($processId);
                if ($output === '') {
                    break;
                }
                $conn->send($output);
            }
        });
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        // Get the correct process for the connection
        $processId = $this->processes[$from->resourceId];

        $this->system->writeInput($processId, $msg);

        while (true) {
            $output = $this->system->readAvailableOutput($processId);
            if ($output === '') {
                break;
            }
            $from->send($output);
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        $this->closeProcess($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
        $this->closeProcess($conn);
    }

    protected function closeProcess(ConnectionInterface $conn) {
        if (isset($this->processes[$conn->resourceId])) {
            $processId = $this->processes[$conn->resourceId];
            // $process->stop();
            $this->system->start($processId);
            unset($this->processes[$conn->resourceId]);
        }
    }

    protected function sendWelcomeMessage(ConnectionInterface $conn)
    {
        $welcomeMessage = "Connected to the terminal. Please wait...\n";
        $conn->send($welcomeMessage);
    }
 }
