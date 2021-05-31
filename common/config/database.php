<?php

return [
	'mysql'=> [
		'target'=>env('MYSQL_DB_HOST', 'localhost'),
		'username'=>env('MYSQL_DB_USERNAME'),
		'password'=>env('MYSQL_DB_PASSWORD'),
		'database'=>env('MYSQL_DB_NAME'),
		'table'=>'',
		'key'=>'_rowid',
		'ignore_null'=>false,
	]
];