<?php
// Retrieve configuration
// global $conn;


 $appConfig= require __DIR__ . '/../config/application.config.php';

\session_start();
 
// require(__DIR__ . '/../core/Controller.php');

require(__DIR__ . '/request.php');

require(__DIR__ . '/router.php');
// require '../src/Model/DbConnectionManager.php';
require(__DIR__ . '/dispatcher.php');


$dispatch = new Dispatcher($appConfig);

$dispatch->dispatch();