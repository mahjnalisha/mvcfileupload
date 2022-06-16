<?php

return [
 
    // database connection parameters
    'connection' => [
        'database_type' => 'mysqli',
        'params' => [
            'host' => 'localhost',
            'port' => '3306',
            'user' => 'root',
            'password' => 'root',
            'dbname' => 'user',
        ]
    ]
];


// define("DB_HOST",      'localhost');
// define('DB_PORT', '3306');
// define("DB_USER",      'root');
// define("DB_PASS",      'root');
// define("DB_NAME",      'user');

// $con = new mysqli(DB_HOST, DB_USER, DB_PASS );

// $GLOBALS['db'] = $con;

// Check connection
// if ($GLOBALS['con']->connect_error) {
// die("Connection failed: " . $GLOBALS['con']->connect_error);
// }else {
// throw new \Exception('Connection injected should be of Mysqli object');
// }
// echo 'here';die;
// \session_start();