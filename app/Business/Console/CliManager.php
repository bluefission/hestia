<?php
namespace App\Business\Console;

use BotMan\BotMan\BotMan;
use BlueFission\Services\Service;
use App\Business\Console\BotMan\CommandLineDriver;

class CliManager extends Service {

	public function __construct( )
    {
		parent::__construct();
	}

	public function cmd()
	{
		print "Type your message. Type '.' on a line by itself when you're done.\n";

		$fp = fopen('php://stdin', 'r');
		$last_line = false;
		$message = '';
		while (!$last_line) {
		    $next_line = fgets($fp, 1024); // read the special file to get the user input from keyboard
		    if (".\n" == $next_line) {
		      $last_line = true;
		    } else {
		      $message .= $next_line;
		    }
		}
	}

	public function chat()
	{
		print "Type your message. Type '.' on a line by itself when you're done.\n";
		echo '> ';
	    $app = \App::instance();
	    $botman = $app->service('botman');

	    $driver = $botman->getDriver();
	    $driver->setBotMan($botman);

	    $fp = fopen('php://stdin', 'r');
	    $last_line = false;
	    while (!$last_line) {
        	printf("%c%c",0x08,0x08);
			echo '> ';

	        $next_line = trim(fgets($fp, 1024)); // read the special file to get the user input from keyboard
	        if ("." == $next_line) {
	            $last_line = true;
	        } else {
	            $this->setBotMessage($botman, $next_line);
	            $botman->listen();
	        }
		}
	}

	public function setBotMessage($botman, $next_line)
	{
	    $driver = $botman->getDriver();
	    if ($driver instanceof CommandLineDriver) {
	        $incomingMessage = new \BotMan\BotMan\Messages\Incoming\IncomingMessage($next_line, 'cli', 'cli');
	        $driver->setMessage($incomingMessage);
	    }
	}
}