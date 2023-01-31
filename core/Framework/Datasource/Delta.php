<?php
namespace BlueFission\Framework\Datasource;
use BlueFission\Connections\Database\MysqlLink;

class Delta {

	public function __construct( MysqlLink $link )
	{
		$link->open();
	}

	public function change()
	{

	}

	public function revert()
	{

	}
}