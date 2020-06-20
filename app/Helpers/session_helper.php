<?php

    session_start();

    function userIsLoggedIn(){

        if(isset($_SESSION["id_usr"])){

            return TRUE;

        }

        return FALSE;

    }

    function loggedUserIsAdmin(){

        if($_SESSION["is_admin_usr"] == "1"){
            return TRUE;
        }

        return FALSE;

    }

    function flash($message_id, $stored_message = ""){

        //$_SESSION["times_called"] += 1;

        if(isset($_SESSION[$message_id])){
            
            $message = $_SESSION[$message_id];
            
            unset($_SESSION[$message_id]);
            
            return $message;
        
        }else if($stored_message != ""){

            $_SESSION[$message_id] = $stored_message;
            return;
        }

        return FALSE;

    }


?>