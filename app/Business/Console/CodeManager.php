<?php
namespace App\Business\Console;

use BlueFission\Services\Service;
use BlueFission\BlueCore\Generation\ScaffoldFactory;

class CodeManager extends Service {

	public function __construct( )
    {
		parent::__construct();
	}

	public function generate( $type, $name, $prompt )
	{
		$factory = new ScaffoldFactory();
		$generator = $factory->createGenerator($type, $templatePath, $outputPath);

		print "Please wait...\n";
		$result = $generator->generate($name, $prompt);

		if ( $result ) {
			print "Success.\n";
		} else {
			print "Something went wrong.\n";
		}

	}