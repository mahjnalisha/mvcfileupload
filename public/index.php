<?php
// Retrieve configuration


$protocol= 'http';  
$web_url= $protocol . "://" . $_SERVER['HTTP_HOST'];
$web_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$web_url .= "://".$_SERVER['HTTP_HOST'];
$web_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

$dir_file = dirname(__FILE__);
// echo dirname(__FILE__);die;

// echo __DIR__ ;
// die;
define("BASE_URL",      $web_url);
define("WEB_ROOT",      $dir_file);

$appConfig= require __DIR__ . '/../config/application.config.php';

\session_start();
 
// require(__DIR__ . '/../core/Controller.php');

require(__DIR__ . '/../request.php');

require(__DIR__ . '/../router.php');
// require '../src/Model/DbConnectionManager.php';
require(__DIR__ . '/../dispatcher.php');


$dispatch = new Dispatcher($appConfig);

$dispatch->dispatch();