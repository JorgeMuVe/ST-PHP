<?php
    class Calificacion{
        private $conn;
        private $table = 'calificacion';

        public function __construct($db){
            $this->conn = $db;
        }

        //AGREGAR Calificacion
        public function agregarCalificacion(){
            $query = 'CALL agregarCalificacion(:tipo,:idCalificado,:idUsuario,:puntuacion,:comentario)';
            $stmt = $this->conn->prepare($query);
            
            $this->idUsuario = htmlspecialchars(strip_tags($this->idUsuario));
            $this->idCalificado = htmlspecialchars(strip_tags($this->idCalificado));
            $this->tipo = htmlspecialchars(strip_tags($this->tipo));
            $this->puntuacion = htmlspecialchars(strip_tags($this->puntuacion));
            $this->comentario = htmlspecialchars(strip_tags($this->comentario));

            $stmt->bindParam(':idUsuario', $this->idUsuario);
            $stmt->bindParam(':idCalificado', $this->idCalificado);
            $stmt->bindParam(':tipo', $this->tipo);
            $stmt->bindParam(':puntuacion', $this->puntuacion);
            $stmt->bindParam(':comentario', $this->comentario);
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }

        // EDITAR COMENTARIO
        public function editarCalificacion(){
            $query = 'CALL editarCalificacion(:tipo,:idCalificado,:idPuntuacion,:idComentario,:puntuacion,:comentario)';
            $stmt = $this->conn->prepare($query);
            
            $this->tipo = htmlspecialchars(strip_tags($this->tipo));
            $this->idCalificado = htmlspecialchars(strip_tags($this->idCalificado));
            $this->idPuntuacion = htmlspecialchars(strip_tags($this->idPuntuacion));
            $this->idComentario = htmlspecialchars(strip_tags($this->idComentario));
            $this->puntuacion = htmlspecialchars(strip_tags($this->puntuacion));
            $this->comentario = htmlspecialchars(strip_tags($this->comentario));

            $stmt->bindParam(':tipo', $this->tipo);
            $stmt->bindParam(':idCalificado', $this->idCalificado);
            $stmt->bindParam(':idPuntuacion', $this->idPuntuacion);
            $stmt->bindParam(':idComentario', $this->idComentario);
            $stmt->bindParam(':puntuacion', $this->puntuacion);
            $stmt->bindParam(':comentario', $this->comentario);

            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }
    }
?>