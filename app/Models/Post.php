<?php

    namespace App\Models;

    class Post {

        public function __construct(){
            $this->db = new \App\Libraries\Database();
        }

        public function register($data){

            $params = [
                "insTitulo" => $data["titulo"],
                "insDescricao" => $data["descricao"],
                "insIdUsuario" => $data["id_usuario"]
            ];

            $stmt = $this->db->execute("INSERT INTO postagens (titulo, descricao, idUsuario) VALUES (:insTitulo, :insDescricao, :insIdUsuario)", $params);

            if($stmt){
                return TRUE;
            }
            return FALSE;


        }

        public function updatePost($data){

            $params = [
                "upId" => $data["id_post"],
                "upTitulo" => $data["titulo"],
                "upDescricao" => $data["descricao"],
            ];

            //var_dump($params);

            $stmt = $this->db->execute("UPDATE postagens SET titulo = :upTitulo, descricao = :upDescricao WHERE idPostagem = :upId", $params);

            if($stmt){
                return TRUE;
            }
            return FALSE;

        }

        public function deletePost($id){

            $params = [
                "delId" => $id,
            ];

            $stmt = $this->db->execute("DELETE * FROM postagens WHERE id = :delId LIMIT 1", $params);

            if($stmt){
                return TRUE;
            }

            return FALSE;

        }

        public function countPosts(){

            $stmt = $this->db->result("SELECT COUNT(*) AS contagem FROM postagens", []);
            return $stmt;

        }

        public function getPostsPaged($current_start_index){
            
            $params = [
                "start_index" => $current_start_index,
                "limitspp" => ITENS_PER_PAGE,
            ];

            $result = $this->db->resultSet("SELECT * FROM postagens ORDER BY idPostagem DESC LIMIT ".$params["limitspp"]. " OFFSET ".$params["start_index"]);

            return $result;

        }

        public function getPostById($id){
            
            $params = [
                "post_id" => $id,
            ];

            $result = $this->db->result("SELECT * FROM postagens WHERE idPostagem = :post_id", $params);

            if($result){
                return $result;
            }

            return FALSE;

        }

    }




?>