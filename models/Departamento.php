<?php
    class Departamento {
        // DB stuff
        private $conn;
        private $table = 'departamento';

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // LISTAR DEPARTAMENTOS
        public function listarDepartamentos(){
            $query = 'SELECT * FROM departamento WHERE habilitado=1';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }
    }
?>