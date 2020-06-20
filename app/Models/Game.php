<?php

namespace App\Models;


class Game{

    public function __construct(){
        $this->db = new \App\Libraries\Database();
    }

    public function register($data){

        $params = [
            "timeCasaIns" => $data["time_casa"],
            "timeAdvIns" => $data["time_adv"],
            "descricaoIns" => $data["descricao"]
        ];

        $stmt = $this->db->execute("INSERT INTO jogos (timeCasa, timeAdv, descricao) VALUES (:timeCasaIns, :timeAdvIns, :descricaoIns)", $params);

        if($stmt){
            return TRUE;
        }

        return FALSE;
    }

    public function getGameById($id){

        $params = [
            "idGame" => $id,
        ];

        $result = $this->db->result("SELECT * FROM jogos WHERE idJogo = :idGame", $params);

        return $result;

    }

    public function updateGame($data){

        $params = [
            "idGame" => $data["id_game"],
            "timeCasaGame" => $data["time_casa"],
            "timeAdvGame" => $data["time_adv"],
            "descricaoGame" => $data["descricao"],

        ];
        //TODO: ENABLE DATE RECORDING
        //"dataGame" => $data["data_jogo"];

        $stmt = $this->db->execute("UPDATE jogos SET timeCasa = :timeCasaGame, timeAdv = :timeAdvGame, descricao = :descricaoGame WHERE idJogo = :idGame", $params);

        if($stmt){
            return TRUE;
        }
        return FALSE;

    }

    public function deleteGame($id){

        $params = [
            "idGame" => $id,
        ];

        $stmt = $this->db->execute("DELETE FROM jogos WHERE idJogo = :idGame", $params);

        if($stmt){
            return TRUE;
        }

        return FALSE;

    }

    public function countGames(){

        $result = $this->db->result("SELECT COUNT(*) AS contagem FROM jogos");

        return $result;

    }

    public function getGamesPaged($current_start_index){

        $params = [

            "index" => $current_start_index,
            "itens" => ITENS_PER_PAGE, 

        ];

        $result = $this->db->resultSet("SELECT * FROM jogos ORDER BY idJogo DESC LIMIT ".$params["itens"]." OFFSET ".$params["index"], []); //TODO: FIX THIS

        return $result;
    }



}

?>