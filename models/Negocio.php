<?php
    class Negocio {
        // DB stuff
        private $conn;
        private $table = 'negocio';

        // Tienda Properties
        public $idNegocio;

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // Agregar Tienda
        public function agregarNegocio() {
            $query='CALL agregarNegocio(:idTipoNegocio,:nombreTienda,
            :ruc,:logo,:correoTienda,:telefonoTienda,:descripcionTienda);';
            $stmt = $this->conn->prepare($query);
            
            $this->idTipoNegocio = htmlspecialchars(strip_tags($this->idTipoNegocio));
            $this->nombreNegocio = htmlspecialchars(strip_tags($this->nombreNegocio));
            $this->ruc = htmlspecialchars(strip_tags($this->ruc));
            $this->logo = htmlspecialchars(strip_tags($this->logo));
            $this->correoNegocio = htmlspecialchars(strip_tags($this->correoNegocio));
            $this->telefonoNegocio = htmlspecialchars(strip_tags($this->telefonoNegocio));
            $this->descripcionNegocio = htmlspecialchars(strip_tags($this->descripcionNegocio));

            $stmt->bindParam(':idTipoNegocio', $this->idTipoNegocio);
            $stmt->bindParam(':nombreNegocio', $this->nombreNegocio);
            $stmt->bindParam(':ruc', $this->ruc);
            $stmt->bindParam(':logo', $this->logo);
            $stmt->bindParam(':correoNegocio', $this->correoNegocio);
            $stmt->bindParam(':telefonoNegocio', $this->telefonoNegocio);
            $stmt->bindParam(':descripcionNegocio', $this->descripcionNegocio);

            $stmt->execute();
            return $stmt;
        }

        // Editar Tienda
        public function editarNegocio(){
            $query = 'CALL editarNegocio(:idNegocio,:idTipoNegocio,:nombreNegocio,
            :ruc,:logo,:correoNegocio,:telefonoNegocio,:descripcionNegocio);';            
            $stmt = $this->conn->prepare($query);
            
            $this->idNegocio = htmlspecialchars(strip_tags($this->idNegocio));
            $this->idTipoNegocio = htmlspecialchars(strip_tags($this->idTipoNegocio));
            $this->nombreNegocio = htmlspecialchars(strip_tags($this->nombreNegocio));
            $this->ruc = htmlspecialchars(strip_tags($this->ruc));
            $this->logo = htmlspecialchars(strip_tags($this->logo));
            $this->correoNegocio = htmlspecialchars(strip_tags($this->correoNegocio));
            $this->telefonoNegocio = htmlspecialchars(strip_tags($this->telefonoNegocio));
            $this->descripcionNegocio = htmlspecialchars(strip_tags($this->descripcionNegocio));
            
            $stmt->bindParam(':idNegocio', $this->idNegocio);
            $stmt->bindParam(':idTipoNegocio', $this->idTipoNegocio);
            $stmt->bindParam(':nombreNegocio', $this->nombreNegocio);
            $stmt->bindParam(':ruc', $this->ruc);
            $stmt->bindParam(':logo', $this->logo);
            $stmt->bindParam(':correoNegocio', $this->correoNegocio);
            $stmt->bindParam(':telefonoNegocio', $this->telefonoNegocio);
            $stmt->bindParam(':descripcionNegocio', $this->descripcionNegocio);
                    
            $stmt->execute();
            
            return $stmt;
        }
    }
?>