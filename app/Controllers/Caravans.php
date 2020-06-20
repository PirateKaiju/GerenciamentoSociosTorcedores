<?php

namespace App\Controllers;

class Caravans extends \App\Libraries\Controller{

    public function __construct(){

        $this->caravanModel = $this->model("Caravan");

        $this->gameModel = $this->model("Game"); //Used for the relationship

    }

    public function index($page = 1){

        //TODO: FILTER CARAVAN BY GAME
        //$this->view("caravans/index", []);

        $total_caravans = $this->caravanModel->countAllCaravans();
        $total_pages = get_total_pages($total_caravans);

        $current_start_index = get_current_start_index($page);
        
        if($page >= 1 && $page <= $total_pages){
            $caravans = [];

            if($caravans = $this->caravanModel->getCaravansPaged($current_start_index)){

                $data = [
                    "total" => $total_caravans,
                    "total_pages" => $total_pages,
                    "page" => $page,
                    "caravans" => $caravans,
                ];

                return $this->view("caravans/index", $data);

            }else{

                //WHEN EMPTY, THIS WILL ALSO BE CALLED...
                die("ERRO 500");

            }

        }else{

            die("404");

        }

    }

    public function register($idGame = null){
        //Offer this functionality on each game page
        //ALT: Implement a list of games for each caravan registration

        if(userIsLoggedIn()){

            if($_SERVER["REQUEST_METHOD"] == "POST"){

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    "nome_caravana" => trim($_POST["nome_caravana"]),
                    "id_jogo" => filter_var($idGame, FILTER_SANITIZE_STRING),
                    "nome_caravana_err" => "",
                ];

                if(!$this->gameModel->getGameById($data["id_jogo"])){
                    redirect("caravans/index");
                }

                //Caravans can be made to any valid game id

                if(empty($data["nome_caravana"])){
                    $data["nome_caravana_err"] = "Preencha um nome válido.";
                }

                if(empty($data["nome_caravana_err"])){

                    //TODO: FINISH 
                    //INSERTS IN BOTH CARAVAN AND USER_CARAVAN (NEW METHOD ON MODEL)

                    if($this->caravanModel->register($data)){

                        //TODO: ENABLE RELATIONSHIP
                        //if($this->caravanModel)
                        redirect("caravans/index");

                    }

                }else{

                    $this->view("caravans/register", $data);

                }


            }else{

                $data = [
                    "id_jogo" => $idGame,
                ];

                $this->view("caravans/register", $data);

            }
        }else{
            redirect("users/login");
        }

    }

    public function edit($id){

    }

    public function delete($id){

        if(loggedUserIsAdmin()){
            $this->caravanModel->delete($id);
            redirect("caravans/index");
        }

    }




}



?>