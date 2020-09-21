<?php
    class Negocio {
        // DB stuff
        private $conn;
        private $table = 'negocio';

        // Negocio Properties
        public $idNegocio;

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // Agregar Negocio
        public function agregarNegocio() {
          $query='CALL agregarNegocio(:idTipoNegocio,:nombreNegocio,:ruc,:correoNegocio,:contrasena);';
          $stmt = $this->conn->prepare($query);
            
          $this->idTipoNegocio = htmlspecialchars(strip_tags($this->idTipoNegocio));
          $this->nombreNegocio = htmlspecialchars(strip_tags($this->nombreNegocio));
          $this->ruc = htmlspecialchars(strip_tags($this->ruc));
          $this->correoNegocio = htmlspecialchars(strip_tags($this->correoNegocio));
          $this->contrasena = htmlspecialchars(strip_tags($this->contrasena));

          $stmt->bindParam(':idTipoNegocio', $this->idTipoNegocio);
          $stmt->bindParam(':nombreNegocio', $this->nombreNegocio);
          $stmt->bindParam(':ruc', $this->ruc);
          $stmt->bindParam(':correoNegocio', $this->correoNegocio);
          $stmt->bindParam(':contrasena', $this->contrasena);

          $stmt->execute();
          return $stmt;
        }

        // Editar Negocio
        public function editarNegocio(){
            $query = 'CALL editarNegocio(:idNegocio,:descripcionNegocio,:telefonoNegocio,:paginaWeb,
            :enlaceFacebook,:enlaceInstagram,:enlaceTwitter,:direccionNegocio,:lat,:lng);';            
            $stmt = $this->conn->prepare($query);
            
            $this->idNegocio = htmlspecialchars(strip_tags($this->idNegocio));
            $this->descripcionNegocio = htmlspecialchars(strip_tags($this->descripcionNegocio));
            $this->telefonoNegocio = htmlspecialchars(strip_tags($this->telefonoNegocio));
            $this->paginaWeb = htmlspecialchars(strip_tags($this->paginaWeb));
            $this->enlaceFacebook = htmlspecialchars(strip_tags($this->enlaceFacebook));
            $this->enlaceInstagram = htmlspecialchars(strip_tags($this->enlaceInstagram));
            $this->enlaceTwitter = htmlspecialchars(strip_tags($this->enlaceTwitter));
            $this->direccionNegocio = htmlspecialchars(strip_tags($this->direccionNegocio));
            $this->lat = htmlspecialchars(strip_tags($this->lat));
            $this->lng = htmlspecialchars(strip_tags($this->lng));

            $stmt->bindParam(':idNegocio', $this->idNegocio);
            $stmt->bindParam(':descripcionNegocio', $this->descripcionNegocio);
            $stmt->bindParam(':telefonoNegocio', $this->telefonoNegocio);
            $stmt->bindParam(':paginaWeb', $this->paginaWeb);
            $stmt->bindParam(':enlaceFacebook', $this->enlaceFacebook);
            $stmt->bindParam(':enlaceInstagram', $this->enlaceInstagram);
            $stmt->bindParam(':enlaceTwitter', $this->enlaceTwitter);
            $stmt->bindParam(':direccionNegocio', $this->direccionNegocio);
            $stmt->bindParam(':lat', $this->lat);
            $stmt->bindParam(':lng', $this->lng);
                    
            $stmt->execute();
            
            return $stmt;
        }

        // Editar Negocio ADMI
        public function editarNegocioAdmi(){
            $query = 'CALL editarNegocioAdmi(:idNegocio,:idTipoNegocio,:nombreNegocio,:ruc);';            
            $stmt = $this->conn->prepare($query);
            
            $this->idNegocio = htmlspecialchars(strip_tags($this->idNegocio));
            $this->idTipoNegocio = htmlspecialchars(strip_tags($this->idTipoNegocio));
            $this->nombreNegocio = htmlspecialchars(strip_tags($this->nombreNegocio));
            $this->ruc = htmlspecialchars(strip_tags($this->ruc));

            $stmt->bindParam(':idNegocio', $this->idNegocio);
            $stmt->bindParam(':idTipoNegocio', $this->idTipoNegocio);
            $stmt->bindParam(':nombreNegocio', $this->nombreNegocio);
            $stmt->bindParam(':ruc', $this->ruc);
                    
            $stmt->execute();
            
            return $stmt;
        }

        // Eliminar Negocio
        public function eliminarNegocio() {
          $query='CALL eliminarNegocio(:idNegocio);';
          $stmt = $this->conn->prepare($query);
            
          $this->idNegocio = htmlspecialchars(strip_tags($this->idNegocio));
          $stmt->bindParam(':idNegocio', $this->idNegocio);

          $stmt->execute();
          return $stmt;
        }

        // Habilitar Negocio
        public function habilitarNegocio(){
            $query = 'UPDATE negocio SET habilitado=:habilitado WHERE idNegocio=:idNegocio;';
            $stmt = $this->conn->prepare($query);
            $this->idNegocio = htmlspecialchars(strip_tags($this->idNegocio));
            $this->habilitado = htmlspecialchars(strip_tags($this->habilitado));
            $stmt->bindParam(':idNegocio', $this->idNegocio);
            $stmt->bindParam(':habilitado', $this->habilitado);
            $stmt->execute();
            return $stmt;
        }

        // Cambiar Portada Negocio
        public function cambiarPortadaNegocio(){
            $query = 'UPDATE negocio SET portada=:portada WHERE idNegocio=:idNegocio;';
            $stmt = $this->conn->prepare($query);
            $this->idNegocio = htmlspecialchars(strip_tags($this->idNegocio));
            $this->portada = htmlspecialchars(strip_tags($this->portada));
            $stmt->bindParam(':idNegocio', $this->idNegocio);
            $stmt->bindParam(':portada', $this->portada);
            $stmt->execute();
            return $stmt;
        }

        // Cambiar logo Negocio
        public function cambiarLogoNegocio(){
            $query = 'UPDATE negocio SET logo=:logo WHERE idNegocio=:idNegocio;';
            $stmt = $this->conn->prepare($query);
            $this->idNegocio = htmlspecialchars(strip_tags($this->idNegocio));
            $this->logo = htmlspecialchars(strip_tags($this->logo));
            $stmt->bindParam(':idNegocio', $this->idNegocio);
            $stmt->bindParam(':logo', $this->logo);
            $stmt->execute();
            return $stmt;
        }

        public function listarNegocios(){
            $queryCantidad = 'SELECT COUNT(*) AS cantidadNegocios FROM negocio';
            $stmtCantidad = $this->conn->prepare($queryCantidad);
            $stmtCantidad->execute();
            if($stmtCantidad){
                $queryBusqueda = 'CALL listarNegocios(:inicio,:cantidad)';
                $stmtBusqueda = $this->conn->prepare($queryBusqueda);

                $this->inicio = htmlspecialchars(strip_tags($this->inicio));
                $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));

                $stmtBusqueda->bindParam(':inicio', $this->inicio);
                $stmtBusqueda->bindParam(':cantidad', $this->cantidad);

                $stmtBusqueda->execute();

                $respuesta = array();
                array_push($respuesta,$stmtCantidad);
                array_push($respuesta,$stmtBusqueda);
                return $respuesta;
            } else { return null; }
        }

        public function listarNegociosPorTipo(){
            $queryCantidad = 'SELECT COUNT(*) AS cantidadNegocios FROM negocio WHERE idTipoNegocio=:idTipoNegocio';
            $stmtCantidad = $this->conn->prepare($queryCantidad);
            
            $this->idTipoNegocio = htmlspecialchars(strip_tags($this->idTipoNegocio));
            $stmtCantidad->bindParam(':idTipoNegocio', $this->idTipoNegocio);
            $stmtCantidad->execute();

            if($stmtCantidad){
                $queryBusqueda = 'CALL listarNegociosCategoria(:idDepartamento,:idProvincia,:idDistrito,:idTipoNegocio);';
                $stmtBusqueda = $this->conn->prepare($queryBusqueda);
                $this->idDepartamento = htmlspecialchars(strip_tags($this->idDepartamento));
                $this->idProvincia = htmlspecialchars(strip_tags($this->idProvincia));
                $this->idDistrito = htmlspecialchars(strip_tags($this->idDistrito));
                $this->idTipoNegocio = htmlspecialchars(strip_tags($this->idTipoNegocio));

                $stmtBusqueda->bindParam(':idDepartamento', $this->idDepartamento);
                $stmtBusqueda->bindParam(':idProvincia', $this->idProvincia);
                $stmtBusqueda->bindParam(':idDistrito', $this->idDistrito);
                $stmtBusqueda->bindParam(':idTipoNegocio', $this->idTipoNegocio);
                $stmtBusqueda->execute();

                $respuesta = array();
                array_push($respuesta,$stmtCantidad);
                array_push($respuesta,$stmtBusqueda);
                return $respuesta;
            } else { return null; }
        }
    }
?>