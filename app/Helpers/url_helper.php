<?php

    function redirect($page){

        header('location: '.URLROOT.'/'.$page);

    }

    function throw_error_404(){

        http_response_code(404);
        require_once("../app/Views/404.php");
        die();

    }


?>