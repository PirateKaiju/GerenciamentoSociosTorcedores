<?php

    namespace App\Libraries;

    class Controller{

        //Defines a base controller

        public function __construct(){
            

        }

        public function view($view, $data = []){
            //Pass a view composed of "Controller Class / View Name"

            if(file_exists("../app/Views/".$view.".php")){

                //data is put in the same context

                require_once "../app/Views/".$view.".php";

            }else{

                throw_error_404();
                //die("Error loading the view");//TODO: HANDLE 404 AND SUCH

            }


        }

        public function model($model){

            //Could also use autoload here
            require_once "../app/Models/".$model.".php";

            $model = '\\App\\Models\\'.$model;

            return new $model();


        }



    }




?>