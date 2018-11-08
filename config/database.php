<?php

$database = array(
		'fetch' => PDO::FETCH_ASSOC,
		'default' => 'slave',
		
		'connections' => array(
				
			
				
				# Slave database connection.
				'slave' => array(
						'driver' => 'mysql',
						'host'  => env('DB_HOST', '127.0.0.1'),
						'port' => env('DB_PORT', 3306),
						'database' => env('DB_DATABASE', 'bdirect_dev_db1'),
						'username' => env('DB_USERNAME', 'devEnggDBver1SLV'),
						'password' => env('DB_PASSWORD', 'MPcwepBzxz3C4aXV'),
				        'charset' => env('DB_CHARSET', 'utf8mb4'),
				        'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
						'prefix' => env('DB_PREFIX', ''),
						
				),
		),
);

return $database;
