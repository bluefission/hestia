<?php

return [
	'mysql'=> [
		'target'=>env('MYSQL_DB_HOST', 'localhost'),
		'username'=>env('MYSQL_DB_USER'),
		'password'=>env('MYSQL_DB_PASS'),
		'database'=>env('MYSQL_DB_HOST'),
		'table'=>'',
		'key'=>'_rowid',
		'ignore_null'=>false,
	]
];