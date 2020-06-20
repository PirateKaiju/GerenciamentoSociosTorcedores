<?php

    namespace App\Controllers;

    class Pages extends \App\Libraries\Controller {


        public function __construct(){


        }

        public function index(){

            //echo "Hello from index!"; //TEST

            //echo "APPROOT: " . APPROOT;

            //echo __FILE__;
            
            //$this->model("Page")->test_page();//TEST

            $this->view("pages/index", []); //TEST



        }

        public function about(){
            $this->view("pages/about", []);
        }

        public function test404(){
            throw_error_404();
        }



    }



?>