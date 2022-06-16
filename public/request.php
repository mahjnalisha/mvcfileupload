<?php
    class Request
    {
        public $url;

        public function __construct()
        {
//            echo $_SERVER["REQUEST_URI"];die;
            $this->url = $_SERVER["REQUEST_URI"];
        }
    }

?>