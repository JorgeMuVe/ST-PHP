<?php
    class Comentario{
        private $conn;
        private $table = 'comentario';

        public function __construct($db){
            $this->conn = $db;
        }

        //AGREGAR COMENTARIO
        public function agregarComentario(){
            $query = 'CALL agregarComentario(:tipoComentario, :idTipoComentario, :textoComentario, :fechaComentario, :idUsuario)';
            $stmt = $this->conn->prepare($query);
            $this->tipoComentario = htmlspecialchars(strip_tags($this->tipoComentario));
            $this->idTipoComentario = htmlspecialchars(strip_tags($this->idTipoComentario));
            $this->textoComentario = htmlspecialchars(strip_tags($this->textoComentario));
            $this->fechaComentario = htmlspecialchars(strip_tags($this->fechaComentario));
            $this->idUsuario = htmlspecialchars(strip_tags($this->idUsuario));
            $stmt->bindParam(':tipoComentario', $this->tipoComentario);
            $stmt->bindParam(':idTipoComentario', $this->idTipoComentario);
            $stmt->bindParam(':textoComentario', $this->textoComentario);
            $stmt->bindParam(':fechaComentario', $this->fechaComentario);
            $stmt->bindParam(':idUsuario', $this->idUsuario);
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }

        // EDITAR COMENTARIO
        public function editarComentario(){
            $query = 'CALL actualizar_comentario(:n_texto, :idUsuario, :n_fecha, :idComentario)';
            $stmt = $this->conn->prepare($query);
            $this->n_texto = htmlspecialchars(strip_tags($this->n_texto));
            $this->idUsuario = htmlspecialchars(strip_tags($this->idUsuario));
            $this->n_fecha = htmlspecialchars(strip_tags($this->n_fecha));
            $this->idComentario = htmlspecialchars(strip_tags($this->idComentario));
            $stmt->bindParam(':n_texto', $this->n_texto);
            $stmt->bindParam(':idUsuario', $this->idUsuario);
            $stmt->bindParam(':n_fecha', $this->n_fecha);
            $stmt->bindParam(':idComentario', $this->idComentario);
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }
        
        // BORRAR COMENTARIO
        public function eliminarComentario(){
            $query = 'CALL eliminarComentario(:idComentario)';
            $stmt = $this->conn->prepare($query);
            $this->idComentario = htmlspecialchars(strip_tags($this->idComentario));        
            $stmt->bindParam(':idComentario', $this->idComentario);
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }

        // LISTAR COMENTARIO PRODUCTO
        public function listarComentarioProducto(){
            $query = 'CALL listarComentarioProducto(:idTipoComentario)';
            $stmt = $this->conn->prepare($query);
            $this->idTipoComentario = htmlspecialchars(strip_tags($this->idTipoComentario));                    
            $stmt->bindParam(':idTipoComentario', $this->idTipoComentario);            
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }

        // LISTAR COMENTARIO TIENDA
        public function listarComentarioTienda(){
            $query = 'CALL listarComentarioTienda(:idTienda)';
            $stmt = $this->conn->prepare($query);
            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));                    
            $stmt->bindParam(':idTienda', $this->idTienda);            
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }

        // LISTAR COMENTARIO NEGOCIO        
        public function listarComentarioNegocio(){
            $query = 'CALL listarComentarioNegocio(:idnegocio)';
            $stmt = $this->conn->prepare($query);
            $this->idnegocio = htmlspecialchars(strip_tags($this->idnegocio));                    
            $stmt->bindParam(':idnegocio', $this->idnegocio);            
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }
    }
?>