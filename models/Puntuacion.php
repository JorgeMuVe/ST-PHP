<?php
    class Puntuacion{
        private $conn;
        private $table = 'puntuacion';

        public function __construct($db){
            $this->conn = $db;
        }

        //AGREGAR COMENTARIO
        public function agregarPuntuacion(){
            $query = 'CALL agregarPuntuacion(:tipoPuntuacion, :idTipoPuntuacion, :nPuntuacion, :fechaPuntuacion, :idUsuario)';
            $stmt = $this->conn->prepare($query);
            $this->tipoPuntuacion = htmlspecialchars(strip_tags($this->tipoPuntuacion));
            $this->idTipoPuntuacion = htmlspecialchars(strip_tags($this->idTipoPuntuacion));
            $this->nPuntuacion = htmlspecialchars(strip_tags($this->nPuntuacion));
            $this->fechaPuntuacion = htmlspecialchars(strip_tags($this->fechaPuntuacion));
            $this->idUsuario = htmlspecialchars(strip_tags($this->idUsuario));
            $stmt->bindParam(':tipoPuntuacion', $this->tipoPuntuacion);
            $stmt->bindParam(':idTipoPuntuacion', $this->idTipoPuntuacion);
            $stmt->bindParam(':nPuntuacion', $this->nPuntuacion);
            $stmt->bindParam(':fechaPuntuacion', $this->fechaPuntuacion);
            $stmt->bindParam(':idUsuario', $this->idUsuario);
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }

        //ACTUALIZAR PUNTUACION 
        public function actualizarPuntuacion(){
            $query = 'CALL actualizarPuntuacion(:idPuntuacion, :nPuntuacion, :fechaPuntuacion)';
            $stmt = $this->conn->prepare($query);
            $this->idPuntuacion = htmlspecialchars(strip_tags($this->idPuntuacion));            
            $this->nPuntuacion = htmlspecialchars(strip_tags($this->nPuntuacion));
            $this->fechaPuntuacion = htmlspecialchars(strip_tags($this->fechaPuntuacion));            
            $stmt->bindParam(':idPuntuacion', $this->idPuntuacion);            
            $stmt->bindParam(':nPuntuacion', $this->nPuntuacion);
            $stmt->bindParam(':fechaPuntuacion', $this->fechaPuntuacion);            
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }  

        //ELIMINAR PUNTUACION
        public function eliminarPuntuacion(){
            $query = 'CALL eliminarPuntuacion(:idPuntuacion)';
            $stmt = $this->conn->prepare($query);
            $this->idPuntuacion = htmlspecialchars(strip_tags($this->idPuntuacion));        
            $stmt->bindParam(':idPuntuacion', $this->idPuntuacion);
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }

        // OBTENER PUNTUACION TOTAL
        public function puntuacionTotal(){
            $query = 'CALL obtenerPuntuacionTotal(:tipoPuntuacion, :idTipoPuntuacion)';
            $stmt = $this->conn->prepare($query);
            $this->tipoPuntuacion = htmlspecialchars(strip_tags($this->tipoPuntuacion));
            $this->idTipoPuntuacion = htmlspecialchars(strip_tags($this->idTipoPuntuacion));        
            $stmt->bindParam(':tipoPuntuacion', $this->tipoPuntuacion);
            $stmt->bindParam(':idTipoPuntuacion', $this->idTipoPuntuacion);
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }

        // OBTENER PUNTUACION USUARIO
        public function puntuacionUsuario(){
            $query = 'CALL obtenerPuntuacionUsuario(:tipoPuntuacion, :idTipoPuntuacion, :idUsuario)';
            $stmt = $this->conn->prepare($query);
            $this->tipoPuntuacion = htmlspecialchars(strip_tags($this->tipoPuntuacion));
            $this->idTipoPuntuacion = htmlspecialchars(strip_tags($this->idTipoPuntuacion));        
            $this->idUsuario = htmlspecialchars(strip_tags($this->idUsuario)); 
            $stmt->bindParam(':tipoPuntuacion', $this->tipoPuntuacion);
            $stmt->bindParam(':idTipoPuntuacion', $this->idTipoPuntuacion);
            $stmt->bindParam(':idUsuario', $this->idUsuario);
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }
    }
?>