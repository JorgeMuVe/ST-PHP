<?php
    class Anuncio {
        // DB stuff
        private $conn;
        private $table = 'anuncio';

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // Agregar Anuncio
        public function agregarAnuncio() {
            $query='CALL agregarAnuncio(:codUsuario,:idCategoria,:idSubCategoria, :fechaPublicacion, :tituloAnuncio, :contenidoAnuncio,
            :precioAnuncio, :idDepartamento,:idProvincia, :idDistrito, :tipoUsuario);';
            $stmt = $this->conn->prepare($query);
            
            $this->tipoUsuario = htmlspecialchars(strip_tags($this->tipoUsuario));
            $this->codUsuario = htmlspecialchars(strip_tags($this->codUsuario));
            $this->idCategoria = htmlspecialchars(strip_tags($this->idCategoria));
            $this->idSubCategoria = htmlspecialchars(strip_tags($this->idSubCategoria));
            $this->fechaPublicacion = htmlspecialchars(strip_tags($this->fechaPublicacion));
            $this->tituloAnuncio = htmlspecialchars(strip_tags($this->tituloAnuncio));
            $this->contenidoAnuncio = htmlspecialchars(strip_tags($this->contenidoAnuncio));
            $this->precioAnuncio = htmlspecialchars(strip_tags($this->precioAnuncio));           
            $this->idDepartamento = htmlspecialchars(strip_tags($this->idDepartamento));
            $this->idProvincia = htmlspecialchars(strip_tags($this->idProvincia));
            $this->idDistrito = htmlspecialchars(strip_tags($this->idDistrito));

            $stmt->bindParam(':tipoUsuario', $this->tipoUsuario);
            $stmt->bindParam(':codUsuario', $this->codUsuario);
            $stmt->bindParam(':idCategoria', $this->idCategoria);
            $stmt->bindParam(':idSubCategoria', $this->idSubCategoria);
            $stmt->bindParam(':fechaPublicacion', $this->fechaPublicacion);
            $stmt->bindParam(':tituloAnuncio', $this->tituloAnuncio);
            $stmt->bindParam(':contenidoAnuncio', $this->contenidoAnuncio);
            $stmt->bindParam(':precioAnuncio', $this->precioAnuncio);            
            $stmt->bindParam(':idDepartamento', $this->idDepartamento);
            $stmt->bindParam(':idProvincia', $this->idProvincia);
            $stmt->bindParam(':idDistrito', $this->idDistrito);

            $stmt->execute();
            return $stmt;
        }

        // Agregar Anuncio Multimedia
        public function agregarAnuncioMultimedia() {
            $query='CALL agregarAnuncioMultimedia(:idAnuncio, :archivoMultimedia);';
            $stmt = $this->conn->prepare($query);
            
            $this->idAnuncio = htmlspecialchars(strip_tags($this->idAnuncio));
            $this->archivoMultimedia = htmlspecialchars(strip_tags($this->archivoMultimedia));
            
            $stmt->bindParam(':idAnuncio', $this->idAnuncio);
            $stmt->bindParam(':archivoMultimedia', $this->archivoMultimedia);
            
            $stmt->execute();
            return $stmt;
        }

        // Editar Anuncio
        public function editarAnuncio() {
            $query='CALL editarAnuncio(:idAnuncio, :idCategoria, :idSubCategoria, :tituloAnuncio, :contenidoAnuncio,
            :precioAnuncio);';
            $stmt = $this->conn->prepare($query);
            
            $this->idAnuncio = htmlspecialchars(strip_tags($this->idAnuncio));            
            $this->idCategoria = htmlspecialchars(strip_tags($this->idCategoria));
            $this->idSubCategoria = htmlspecialchars(strip_tags($this->idSubCategoria));            
            $this->tituloAnuncio = htmlspecialchars(strip_tags($this->tituloAnuncio));
            $this->contenidoAnuncio = htmlspecialchars(strip_tags($this->contenidoAnuncio));
            $this->precioAnuncio = htmlspecialchars(strip_tags($this->precioAnuncio));                       
            /* $this->fechaPublicacion = htmlspecialchars(strip_tags($this->fechaPublicacion)); 
            $this->idDepartamento = htmlspecialchars(strip_tags($this->idDepartamento));
            $this->idProvincia = htmlspecialchars(strip_tags($this->idProvincia));
            $this->idDistrito = htmlspecialchars(strip_tags($this->idDistrito)); */

            $stmt->bindParam(':idAnuncio', $this->idAnuncio);
            /* $stmt->bindParam(':tipoUsuario', $this->tipoUsuario);
            $stmt->bindParam(':codUsuario', $this->codUsuario); */
            $stmt->bindParam(':idCategoria', $this->idCategoria);
            $stmt->bindParam(':idSubCategoria', $this->idSubCategoria);
            /* $stmt->bindParam(':fechaPublicacion', $this->fechaPublicacion); */
            $stmt->bindParam(':tituloAnuncio', $this->tituloAnuncio);
            $stmt->bindParam(':contenidoAnuncio', $this->contenidoAnuncio);
            $stmt->bindParam(':precioAnuncio', $this->precioAnuncio);            
            /* $stmt->bindParam(':idDepartamento', $this->idDepartamento);
            $stmt->bindParam(':idProvincia', $this->idProvincia);
            $stmt->bindParam(':idDistrito', $this->idDistrito);  */          

            $stmt->execute();
            return $stmt;
        }     

        // Eliminar Anuncio
        public function eliminarAnuncio() {
            $query='CALL eliminarAnuncio(:idAnuncio);';
            $stmt = $this->conn->prepare($query);
            
            $this->idAnuncio = htmlspecialchars(strip_tags($this->idAnuncio));            
            $stmt->bindParam(':idAnuncio', $this->idAnuncio);            

            $stmt->execute();
            return $stmt;
        }

        // Publicar Anuncio
        public function publicarAnuncio() {
            $query='CALL publicarAnuncio(:idAnuncio);';
            $stmt = $this->conn->prepare($query);
            
            $this->idAnuncio = htmlspecialchars(strip_tags($this->idAnuncio));            
            $stmt->bindParam(':idAnuncio', $this->idAnuncio);            

            $stmt->execute();
            return $stmt;
        }

        // Listar Anuncios por Categoria
        public function listarAnuncioPorCategoria() {
            $query='CALL listarAnuncioPorCategoria(:idCategoria, :estado);';
            $stmt = $this->conn->prepare($query);
            
            $this->idCategoria = htmlspecialchars(strip_tags($this->idCategoria));
            $this->estado = htmlspecialchars(strip_tags($this->estado));
            $stmt->bindParam(':idCategoria', $this->idCategoria);
            $stmt->bindParam(':estado', $this->estado);

            $stmt->execute();
            return $stmt;
        } 

        // Listar Anuncios por Sub-Categoria
        public function listarAnuncioPorSubCategoria() {
            $query='CALL listarAnuncioPorCategoria(:idCategoria);';
            $stmt = $this->conn->prepare($query);
            
            $this->idCategoria = htmlspecialchars(strip_tags($this->idCategoria));            
            $stmt->bindParam(':idCategoria', $this->idCategoria);            

            $stmt->execute();
            return $stmt;
        }

        // Listar Anuncios por Usuario
        public function listarAnuncioPorUsuario() {
            $query='CALL listarAnuncioUsuario(:tipoUsuario, :codUsuario);';
            $stmt = $this->conn->prepare($query);

            $this->tipoUsuario = htmlspecialchars(strip_tags($this->tipoUsuario));
            $this->codUsuario = htmlspecialchars(strip_tags($this->codUsuario));
            $stmt->bindParam(':tipoUsuario', $this->tipoUsuario);
            $stmt->bindParam(':codUsuario', $this->codUsuario);

            $stmt->execute();
            return $stmt;
        }

        // Listar Imagenes por Anuncio
        public function listarAnuncioImagenes() {
            $query='CALL listarAnuncioImagenes(:idAnuncio);';
            $stmt = $this->conn->prepare($query);
            
            $this->idAnuncio = htmlspecialchars(strip_tags($this->idAnuncio));            
            $stmt->bindParam(':idAnuncio', $this->idAnuncio);            

            $stmt->execute();
            return $stmt;
        }

        // Listar Categorias
        public function listarCategoria() {
            $query='CALL listarCategoria();';
            $stmt = $this->conn->prepare($query);

            $stmt->execute();
            return $stmt;
        }

        // Listar Sub-Categorias
        public function listarSubCategoria() {
            $query='CALL listarSubCategoria(:idCategoria);';
            $stmt = $this->conn->prepare($query);

            $this->idCategoria = htmlspecialchars(strip_tags($this->idCategoria));            
            $stmt->bindParam(':idCategoria', $this->idCategoria);         

            $stmt->execute();
            return $stmt;
        }
    }
?>