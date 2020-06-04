<?php
    class Database {
        // DB Paramas

        private $host = '127.0.0.1';
        private $username = 'u3yut93z9uwr5';
        private $password = 'Worldconnect2020';
        private $db_name = 'dbc9vkbmvcc2cx';
        private $conn;

        // DB Connect
        public function connect(){
            $this->conn = null;
            try{
                $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,$this->username,$this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo 'Connection Error: '. $e->getMessage();
            }
            return $this->conn;
        }
        
    }