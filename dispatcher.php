<?php

require(__DIR__ . '/DbConnection.php');
class Dispatcher
{

    private $request;
    private $logs;
    public $db_conn;
    public function __construct($appConfig)
    {
        $db = new DbConnection($appConfig);
        if ($db) {
            $this->db_conn = $db->getConnection();
        }
       
        $GLOBALS['db']= $this->db_conn;
    }

    public function dispatch()
    {
        
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);
        if(empty($this->request->controller) && empty( $this->request->action)){
            $this->request->controller= 'User';
            $this->request->action= 'index';
        }
        if(empty($this->request->action)){
            $this->request->action= 'index';
        }
        $controller = $this->loadController();
      
        call_user_func_array([$controller, $this->request->action], $this->request->params);
    }

    public function loadController()
    {

        $name = $this->request->controller . "Controller";
        $file = '../src/Controller/' . ucfirst($name) . '.php';

        require_once($file);
       
        // echo $file;die;
        $controller = new $name();

        return $controller;


    }

}
?>