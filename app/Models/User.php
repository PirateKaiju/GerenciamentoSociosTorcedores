<?php

    namespace App\Models;

    class User{

        public function __construct(){
            $this->db = new \App\Libraries\Database();
        }

        public function getAllUsers(){

            $users = $this->db->resultSet("SELECT * FROM usuarios", []);

            return $users;

        }

        public function login($data){

            $params = [
                "emailUsr" => $data["email_usr"]
            ];

            $result = $this->db->result("SELECT * FROM usuarios WHERE email = :emailUsr", $params);

            $hashed_password = $result->senha;

            if(password_verify($data["senha_usr"], $hashed_password)){
                return $result;
            }

            return FALSE;

        }

        public function register($data){

            $params = [
                "nomeUsr" => $data["nome_usr"],
                "dataNascUsr" => $data["data_nasc_usr"],
                "emailUsr" => $data["email_usr"],
                "senhaUsr" => $data["senha_usr"],
                "isAdmin" => 0
            ];

            $stmt = $this->db->execute("INSERT INTO usuarios (nome, dataNasc, email, senha, is_admin) VALUES (:nomeUsr, :dataNascUsr, :emailUsr, :senhaUsr, :isAdmin)", $params);

            if($stmt){
                return TRUE;
            }
            
            return FALSE;

        }

        public function emailExists($email){

            $params = [
                "emailUsr" => $email
            ];

            $stmt = $this->db->result("SELECT * FROM usuarios WHERE email = :emailUsr", $params);
            
            if($stmt){
                return TRUE;
            }
            return FALSE;

        }

        public function isUserEmail($email, $id){

            //Current email belongs to user which has $id?

            $params = [
                "emailUsr" => $email
            ];

            $stmt = $this->db->result("SELECT * FROM usuarios WHERE email = :emailUsr", $params);
            
            if($stmt->idUsuario == $id){
                return TRUE;
            }
            return FALSE;

        }

        public function getUserById($id){
            
            $params = [
                "id_usr" => $id
            ];

            $result = $this->db->result("SELECT * FROM usuarios WHERE idUsuario = :id_usr", $params);

            return $result;
        }

        public function updateUser($data){

            //TODO: ENABLE DATE RECORDING
            $params = [
                "idUsr" => $data["id_usr"],
                "nomeUsr" => $data["nome_usr"],
                "emailUsr" => $data["email_usr"],
                "senhaUsr" => $data["senha_usr"],
            ];

            //"dataNascUsr" => $data["data_nasc_usr"],

            $stmt = $this->db->execute("UPDATE usuarios SET nome = :nomeUsr, email = :emailUsr, senha = :senhaUsr WHERE idUsuario = :idUsr ", $params);

            if($stmt){
                return TRUE;
            }

            return FALSE;

        }

        public function delete($id){

            $params = [
                "idUser" => $id,
            ];

            $stmt = $this->db->execute("DELETE FROM usuarios WHERE idUsuario = :idUser", $params);

            if($stmt){
                return TRUE;
            }
            return FALSE;
        }

        public function countUsers(){

            $stmt = $this->db->result("SELECT COUNT(*) AS contagem FROM usuarios");

            return $stmt;

        }

        public function getUsersPaged($page_index){

            $params = [
                "start_index" => $page_index,
                "resultspp" => ITENS_PER_PAGE, 
            ];

            //LIMITS CANNOT BE PASSED AS PARAMS BECAUSE THEYLL BE TREATED AS STRINGS
            $result = $this->db->resultSet("SELECT * FROM usuarios ORDER BY idUsuario DESC LIMIT ".$params["resultspp"]." OFFSET ".$params["start_index"], []); //TODO: FIX THIS

            return $result;

        }

    }


?>