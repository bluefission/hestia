<?php
namespace App\Business\Console;

use BlueFission\Services\Service;

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
}