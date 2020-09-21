<?php
    class Distrito {
        // DB stuff
        private $conn;
        private $table = 'distrito';

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // LISTAR DISTRITOS
        public function listarDistritos(){
            $query = 'SELECT * FROM distrito WHERE idProvincia=:idProvincia AND habilitado=1';
            $stmt = $this->conn->prepare($query);
            $this->idProvincia = htmlspecialchars(strip_tags($this->idProvincia));
            $stmt->bindParam(':idProvincia', $this->idProvincia);
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }
    }
?>