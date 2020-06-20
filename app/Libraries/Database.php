<?php

    namespace App\Libraries;

    class Database{

        private $host = "localhost"; //TODO: FILL IN ALL
        private $db = "torcedores2";
        private $user = "admintorcedoresv2";
        private $pass = "torcedor123";

        private $conn = null;



        public function __construct(){
            //Creates pdo object and store it in conn
            $dsn = "mysql:host=$this->host;dbname=$this->db;";

            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ];

            try{

                $this->conn = new \PDO($dsn, $this->user, $this->pass, $options);

            }catch (\PDOException $e){

                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }

        }

        public function execute($stmt, $params = []){

            $stmt = $this->conn->prepare($stmt);

            if($params){
                $stmt->execute($params);
            }else{
                $stmt->execute();
            }

            return $stmt;
        }

        public function result($stmt, $params = []){

            $stmt = $this->execute($stmt, $params);

            return $stmt->fetch(\PDO::FETCH_OBJ);

        }

        public function resultSet($stmt, $params = []){

            $stmt = $this->execute($stmt, $params);

            return $stmt->fetchAll(\PDO::FETCH_OBJ);


        }



    }


?>