<?php

return [
	'html' => [
		'file'=>'',
		'cache'=>true,
		'cache_expire'=>60,
		'cache_directory'=>env('CACHE_DIRECTORY', 'cache/').'template',
		'max_records'=>1000, 
		'delimiter_start'=>'{', 
		'delimiter_end'=>'}',
		'module_token'=>'mod', 
		'module_directory'=>'modules/',
		'format'=>false,
		'eval'=>false,
	]
];