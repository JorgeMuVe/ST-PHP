<?php
    class Tienda {
        // DB stuff
        private $conn;
        private $table = 'tienda';

        // Tienda Properties
        public $idTienda;

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // Agregar Tienda
        public function agregarTienda() {
            $query='CALL agregarTienda(:idNegocio,:idTipoNegocio,:nombreTienda,
            :ruc,:logo,:portada,:correoTienda,:telefonoTienda,:descripcionTienda,:direccionTienda,
            :idDepartamento,:idProvincia,:idDistrito,:lat,:lng,:contrasena);';
            $stmt = $this->conn->prepare($query);
            
            $this->idNegocio = htmlspecialchars(strip_tags($this->idNegocio));
            $this->idTipoNegocio = htmlspecialchars(strip_tags($this->idTipoNegocio));
            $this->nombreTienda = htmlspecialchars(strip_tags($this->nombreTienda));
            $this->ruc = htmlspecialchars(strip_tags($this->ruc));
            $this->logo = htmlspecialchars(strip_tags($this->logo));
            $this->portada = htmlspecialchars(strip_tags($this->portada));            
            $this->correoTienda = htmlspecialchars(strip_tags($this->correoTienda));
            $this->telefonoTienda = htmlspecialchars(strip_tags($this->telefonoTienda));
            $this->descripcionTienda = htmlspecialchars(strip_tags($this->descripcionTienda));
            $this->direccionTienda = htmlspecialchars(strip_tags($this->direccionTienda));
            $this->idDepartamento = htmlspecialchars(strip_tags($this->idDepartamento));
            $this->idProvincia = htmlspecialchars(strip_tags($this->idProvincia));
            $this->idDistrito = htmlspecialchars(strip_tags($this->idDistrito));
            $this->lat = htmlspecialchars(strip_tags($this->lat));
            $this->lng = htmlspecialchars(strip_tags($this->lng));
            $this->contrasena = htmlspecialchars(strip_tags($this->contrasena));

            $stmt->bindParam(':idNegocio', $this->idNegocio);
            $stmt->bindParam(':idTipoNegocio', $this->idTipoNegocio);
            $stmt->bindParam(':nombreTienda', $this->nombreTienda);
            $stmt->bindParam(':ruc', $this->ruc);
            $stmt->bindParam(':logo', $this->logo);
            $stmt->bindParam(':portada', $this->portada);            
            $stmt->bindParam(':correoTienda', $this->correoTienda);
            $stmt->bindParam(':telefonoTienda', $this->telefonoTienda);
            $stmt->bindParam(':descripcionTienda', $this->descripcionTienda);
            $stmt->bindParam(':direccionTienda', $this->direccionTienda);
            $stmt->bindParam(':idDepartamento', $this->idDepartamento);
            $stmt->bindParam(':idProvincia', $this->idProvincia);
            $stmt->bindParam(':idDistrito', $this->idDistrito);
            $stmt->bindParam(':lat', $this->lat);
            $stmt->bindParam(':lng', $this->lng);
            $stmt->bindParam(':contrasena', $this->contrasena);

            $stmt->execute();
            return $stmt;
        }

        // Datos Tienda
        public function datosTienda(){
            $query = 'SELECT * FROM tienda WHERE idTienda = :idTienda';
            $stmt = $this->conn->prepare($query);
            
            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));
            $stmt->bindParam(':idTienda', $this->idTienda);

            $stmt->execute();            
            if($stmt){ return $stmt; }
            else { return null; }
        }

        // Editar Tienda
        public function editarTienda(){
            $query = 'CALL editarTienda(:idTienda,:descripcionTienda,:telefonoTienda,:paginaWeb,
            :enlaceFacebook,:enlaceInstagram,:enlaceTwitter,:direccionTienda,:lat,:lng);';            
            $stmt = $this->conn->prepare($query);

            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));
            $this->descripcionTienda = htmlspecialchars(strip_tags($this->descripcionTienda));
            $this->telefonoTienda = htmlspecialchars(strip_tags($this->telefonoTienda));
            $this->paginaWeb = htmlspecialchars(strip_tags($this->paginaWeb));
            $this->enlaceFacebook = htmlspecialchars(strip_tags($this->enlaceFacebook));
            $this->enlaceInstagram = htmlspecialchars(strip_tags($this->enlaceInstagram));
            $this->enlaceTwitter = htmlspecialchars(strip_tags($this->enlaceTwitter));
            $this->direccionTienda = htmlspecialchars(strip_tags($this->direccionTienda));
            $this->lat = htmlspecialchars(strip_tags($this->lat));
            $this->lng = htmlspecialchars(strip_tags($this->lng));

            $stmt->bindParam(':idTienda', $this->idTienda);
            $stmt->bindParam(':descripcionTienda', $this->descripcionTienda);
            $stmt->bindParam(':telefonoTienda', $this->telefonoTienda);
            $stmt->bindParam(':paginaWeb', $this->paginaWeb);
            $stmt->bindParam(':enlaceFacebook', $this->enlaceFacebook);
            $stmt->bindParam(':enlaceInstagram', $this->enlaceInstagram);
            $stmt->bindParam(':enlaceTwitter', $this->enlaceTwitter);
            $stmt->bindParam(':direccionTienda', $this->direccionTienda);
            $stmt->bindParam(':lat', $this->lat);
            $stmt->bindParam(':lng', $this->lng);
                    
            $stmt->execute();
            
            return $stmt;
        }

        // Eliminar Tienda
        public function eliminarTienda(){
            $query = 'CALL eliminarTienda(:idTienda);';
            $stmt = $this->conn->prepare($query);
            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));
            $stmt->bindParam(':idTienda', $this->idTienda);
            $stmt->execute();
            return $stmt;
        }

        // Habilitar Tienda
        public function habilitarTienda(){
            $query = 'UPDATE tienda SET habilitado=:habilitado WHERE idTienda=:idTienda;';
            $stmt = $this->conn->prepare($query);
            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));
            $this->habilitado = htmlspecialchars(strip_tags($this->habilitado));
            $stmt->bindParam(':idTienda', $this->idTienda);
            $stmt->bindParam(':habilitado', $this->habilitado);
            $stmt->execute();
            return $stmt;
        }

        // Habilitar Delivery Tienda
        public function habilitarDeliveryTienda(){
            $query = 'UPDATE tienda SET sDelivery=:sDelivery WHERE idTienda=:idTienda;';
            $stmt = $this->conn->prepare($query);
            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));
            $this->sDelivery = htmlspecialchars(strip_tags($this->sDelivery));
            $stmt->bindParam(':idTienda', $this->idTienda);
            $stmt->bindParam(':sDelivery', $this->sDelivery);
            $stmt->execute();
            return $stmt;
        }

        // Cambiar Portada Tienda
        public function cambiarPortadaTienda(){
            $query = 'UPDATE tienda SET portada=:portada WHERE idTienda=:idTienda;';
            $stmt = $this->conn->prepare($query);
            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));
            $this->portada = htmlspecialchars(strip_tags($this->portada));
            $stmt->bindParam(':idTienda', $this->idTienda);
            $stmt->bindParam(':portada', $this->portada);
            $stmt->execute();
            return $stmt;
        }

        // Cambiar logo Tienda
        public function cambiarLogoTienda(){
            $query = 'UPDATE tienda SET logo=:logo, marcador=:marcador WHERE idTienda=:idTienda;';
            $stmt = $this->conn->prepare($query);
            
            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));
            $this->logo = htmlspecialchars(strip_tags($this->logo));
            $this->marcador = htmlspecialchars(strip_tags($this->marcador));
            
            $stmt->bindParam(':idTienda', $this->idTienda);
            $stmt->bindParam(':logo', $this->logo);
            $stmt->bindParam(':marcador', $this->marcador);
            
            $stmt->execute();
            return $stmt;
        }

        // Listar Tiendas De Negocio
        public function listarTiendasNegocio(){
            $queryCantidad = 'SELECT COUNT(*) AS cantidadTiendas FROM tienda WHERE idNegocio = :codigoUsuario';
            $stmtCantidad = $this->conn->prepare($queryCantidad);

            $this->codigoUsuario = htmlspecialchars(strip_tags($this->codigoUsuario));
            $stmtCantidad->bindParam(':codigoUsuario', $this->codigoUsuario);

            $stmtCantidad->execute();
            if($stmtCantidad){
                $queryBusqueda = 'CALL listarTiendasNegocio(:codigoUsuario,:inicio,:cantidad)';
                $stmtBusqueda = $this->conn->prepare($queryBusqueda);
                
                $this->codigoUsuario = htmlspecialchars(strip_tags($this->codigoUsuario));
                $this->inicio = htmlspecialchars(strip_tags($this->inicio));
                $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));
        
                $stmtBusqueda->bindParam(':codigoUsuario', $this->codigoUsuario);
                $stmtBusqueda->bindParam(':inicio', $this->inicio);
                $stmtBusqueda->bindParam(':cantidad', $this->cantidad);

                $stmtBusqueda->execute();

                $respuesta = array();
                array_push($respuesta,$stmtCantidad);
                array_push($respuesta,$stmtBusqueda);
                
                return $respuesta;
            } else { return null; }
        }

        // Listar Negocios por Tipo
        public function listarNegociosTipo(){
            $queryCantidad = 'SELECT COUNT(*) AS cantidadNegocios FROM negocio n 
            INNER JOIN tipoNegocio tn ON n.idTipoNegocio = tn.idTipoNegocio
            AND tn.nombreTipoNegocio = :tipoNegocio';
            $stmtCantidad = $this->conn->prepare($queryCantidad);

            $this->tipoNegocio = htmlspecialchars(strip_tags($this->tipoNegocio));
            $stmtCantidad->bindParam(':tipoNegocio', $this->tipoNegocio);

            $stmtCantidad->execute();
            if($stmtCantidad){
                $queryBusqueda = 'CALL listarNegociosTipo(:tipoNegocio,:inicio,:cantidad)';
                $stmtBusqueda = $this->conn->prepare($queryBusqueda);
                
                $this->tipoNegocio = htmlspecialchars(strip_tags($this->tipoNegocio));
                $this->inicio = htmlspecialchars(strip_tags($this->inicio));
                $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));
        
                $stmtBusqueda->bindParam(':tipoNegocio', $this->tipoNegocio);
                $stmtBusqueda->bindParam(':inicio', $this->inicio);
                $stmtBusqueda->bindParam(':cantidad', $this->cantidad);

                $stmtBusqueda->execute();

                $respuesta = array();
                array_push($respuesta,$stmtCantidad);
                array_push($respuesta,$stmtBusqueda);
                
                return $respuesta;
            } else { return null; }
        }

        // LISTAR TIPOS DE NEGOCIO
        public function listarTiposNegocio(){
            $query = 'SELECT * FROM tipoNegocio;';
            $stmt = $this->conn->prepare($query);
            // Execute Query
            $stmt->execute();
            return $stmt;
        }
    }
?>