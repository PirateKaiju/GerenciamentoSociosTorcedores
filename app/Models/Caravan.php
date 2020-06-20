<?php

    namespace App\Models;

    class Caravan{

        public function __construct(){
            $this->db = new \App\Libraries\Database();
        }

        public function register($data){

            $params = [
                "nome_caravana" => $data["nome_caravana"],
                "id_jogo" => $data["id_jogo"],
            ];

            $stmt = $this->db->execute("INSERT INTO caravanas (nome, idJogo) VALUES (:nome_caravana, :id_jogo)", $params);

            if($stmt){
                return TRUE;
            }
            return FALSE;

        }

        public function countAllCaravans(){

            $result = $this->db->result("SELECT COUNT(*) AS contagem FROM caravanas", []);

            return $result;
        }

        public function getCaravansPaged($current_start_index){

            $params = [
                "index" => $current_start_index,
                "limit" => 5,
            ];

            $stmt = $this->db->resultSet("SELECT * FROM caravanas ORDER BY idCaravana LIMIT ".$params["limit"]." OFFSET ".$params["index"], []);

            return $stmt;
        }


        public function delete($id){
            $params = [
                "idCaravan" => $id,
            ];

            $stmt = $this->db->execute("DELETE 1 FROM caravanas WHERE idCaravana = :idCaravan", $params);

            return $stmt;

        }

    }


?>