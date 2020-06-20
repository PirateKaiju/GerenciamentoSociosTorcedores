<?php

namespace App\Controllers;

class Games extends \App\Libraries\Controller{


    public function __construct(){
        $this->gameModel = $this->model("Game");
    }

    public function index($page = 1){

        //TODO:PAGINATION

        $total_games = $this->gameModel->countGames();
        $total_pages = get_total_pages($total_games->contagem);

        $current_start_index = get_current_start_index($page);

        if($page >= 1 && $page <= $total_pages){

            //die("Here");
            $games = [];

            if($games = $this->gameModel->getGamesPaged($current_start_index)){

                $data = [

                    "total" => $total_games,
                    "total_pages" => $total_pages,
                    "page" => $page,
                    "games" => $games,

                ];

                //die("Here");
                return $this->view("games/index", $data);

            }else{

                die(500);

            }
    
        }else{

            die(404);

        }
    }

    public function register(){

        if(loggedUserIsAdmin()){
            //Admin only

            if($_SERVER["REQUEST_METHOD"] == "POST"){

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    "time_casa" => trim($_POST["time_casa"]),
                    "time_adv" => trim($_POST["time_adv"]),
                    "data_jogo" => trim($_POST["data_jogo"]),
                    "descricao" => trim($_POST["descricao"]),
                    "time_casa_err" => "",
                    "time_adv_err" => "",
                    "data_jogo_err" => "",
                    "descricao_err" => "",
                    
                ];

                if(empty($data["time_casa"])){
                    $data["time_casa_err"] = "Insira o nome do time da casa";
                }

                if(empty($data["time_adv"])){
                    $data["time_adv_err"] = "Insira o nome do time adversário";
                }

                if(empty($data["descricao"])){
                    $data["descricao_err"] = "Preencha a descrição da partida";
                }

                if(empty($data["time_casa_err"]) && empty($data["time_adv_err"]) && empty($data["descricao_err"])){


                    if($this->gameModel->register($data)){
                        //TODO: FLASHING SYSTEM
                        redirect("games/index");
                    }else{

                        die("Algum erro aconteceu! Manutenção reportada!");
                    }


                }else{

                    $this->view("games/register", $data);
                }


            }else{

                $data = [];

                $this->view("games/register", $data);

            }

        }else{

            redirect("games/index");

        }

    }

    public function edit($id){

        if(loggedUserIsAdmin() && ($currentGame = $this->gameModel->getGameById($id))){


            if($_SERVER["REQUEST_METHOD"] == "POST"){

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    "id_game" => $currentGame->idJogo,
                    "time_casa" => trim($_POST["time_casa"]),
                    "time_adv" => trim($_POST["time_adv"]),
                    "data_jogo" => trim($_POST["data_jogo"]),
                    "descricao" => trim($_POST["descricao"]),

                ];

                if(empty($data["time_casa"])){
                    $data["time_casa_err"] = "Insira o nome do time da casa";
                }

                if(empty($data["time_adv"])){
                    $data["time_adv_err"] = "Insira o nome do time adversário";
                }

                if(empty($data["descricao"])){
                    $data["descricao_err"] = "Preencha a descrição da partida";
                }

                if(empty($data["time_casa_err"]) && empty($data["time_adv_err"]) && empty($data["descricao_err"])){

                    if($this->gameModel->updateGame($data)){

                        redirect("games/index");

                    }else{

                        die("Algum erro aconteceu! Manutenção reportada!");

                    }

                }else{

                    $this->view("games/edit", $data);

                }


            }else{

                $data = [

                    "id_game" => $currentGame->idJogo,
                    "time_casa" => $currentGame->timeCasa,
                    "time_adv" => $currentGame->timeAdv,
                    "data_jogo" => $currentGame->dataJogo,
                    "descricao" => $currentGame->descricao, 
    
                ];

                //var_dump($currentGame);


                $this->view("games/edit", $data);

            }

        }else{

            redirect("games/index");
        }

    }

    public function delete($id){
        
        if(loggedUserIsAdmin()){

            if($this->gameModel->getGameById($id)){

                if($this->gameModel->deleteGame($id)){
                
                    redirect("games/index");
                }
            }

        }

    }

    public function show($id = null){

        $id = filter_var($id, FILTER_SANITIZE_STRING);

        $game = $this->gameModel->getGameById($id);

        if($game){

            $data = [
                "game" => $game,
            ];

            return $this->view("games/show", $data);
        }

        //TODO: 500
        return die(500);

    }
}


?>