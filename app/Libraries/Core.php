<?php

    namespace App\Libraries;

    //use \App\Controllers\Pages as Pages;

    class Core{

        //private $url;
        private $current_controller = 'Pages';
        private $current_method = 'index';
        private $parameters = [];




        public function __construct(){

            $current_url = $this->get_url();

             //var_dump($current_url);
            
            if(file_exists('../app/Controllers/'.ucwords($current_url[0]).'.php')){

                $this->current_controller = ucwords($current_url[0]);
                unset($current_url[0]);

            }

            require_once '../app/Controllers/'.$this->current_controller.'.php';

            //var_dump($this->current_controller);//TEST


            //Completing the needed namespace. Since all controllers are located on same place, use as such.
            $this->current_controller = '\\App\\Controllers\\'.$this->current_controller;

            //$this->current_controller = new \App\Controllers\Pages;//$this->current_controller;//TEST
            $this->current_controller = new $this->current_controller;//$this->current_controller;

            //var_dump($this->current_controller);
            //var_dump($current_url);
            
            if(isset($current_url[1])){

                if(method_exists($this->current_controller, $current_url[1])){

                    $this->current_method = $current_url[1];
                    unset($current_url[1]);

                    //var_dump($this->current_method);//TEST

                }

            }

            $this->parameters = $current_url ? array_values($current_url) : [];

            call_user_func_array([$this->current_controller, $this->current_method], $this->parameters);

            




        }

        public function get_url(){

            //$current_url = $_REQUEST["url"];
            if(isset($_GET["url"])){

                $url = rtrim($_GET["url"], '/');
                $url = filter_var($url, FILTER_SANITIZE_STRING);
                $url = explode('/', $url);

                return $url;



            }

        }




    }





?>