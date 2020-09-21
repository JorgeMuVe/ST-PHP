<?php
    class Provincia {
        // DB stuff
        private $conn;
        private $table = 'provincia';

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // LISTAR DEPARTAMENTOS
        public function listarProvincias(){
            $query = 'SELECT * FROM provincia WHERE idDepartamento=:idDepartamento AND habilitado=1';
            $stmt = $this->conn->prepare($query);
            $this->idDepartamento = htmlspecialchars(strip_tags($this->idDepartamento));
            $stmt->bindParam(':idDepartamento', $this->idDepartamento);
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }
    }
?>