<?php
require 'vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory;
use React\Socket\Server;
use App\Terminal;

$loop = Factory::create();
$port = 8080;
// $socket = new Server("0.0.0.0:{$port}", $loop);

try {
    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new Terminal($loop)
            )
        ),
        $port,
        '0.0.0.0'
    );

    echo "WebSocket server listening on port {$port}\n";

    $server->run();
} catch (Exception $e) {
    echo "Error starting WebSocket server: " . $e->getMessage() . "\n";
}