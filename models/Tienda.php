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
            $query='CALL agregarTienda(:idNegocio,:idTipoNegocio,:numeroTienda,:nombreTienda,
            :ruc,:logo,:correoTienda,:telefonoTienda,:direccionTienda,:descripcionTienda,:lat,:lng,:contrasena);';
            $stmt = $this->conn->prepare($query);
            
            $this->idNegocio = htmlspecialchars(strip_tags($this->idNegocio));
            $this->idTipoNegocio = htmlspecialchars(strip_tags($this->idTipoNegocio));
            $this->numeroTienda = htmlspecialchars(strip_tags($this->numeroTienda));
            $this->nombreTienda = htmlspecialchars(strip_tags($this->nombreTienda));
            $this->ruc = htmlspecialchars(strip_tags($this->ruc));
            $this->logo = htmlspecialchars(strip_tags($this->logo));
            $this->correoTienda = htmlspecialchars(strip_tags($this->correoTienda));
            $this->telefonoTienda = htmlspecialchars(strip_tags($this->telefonoTienda));
            $this->direccionTienda = htmlspecialchars(strip_tags($this->direccionTienda));
            $this->descripcionTienda = htmlspecialchars(strip_tags($this->descripcionTienda));
            $this->lat = htmlspecialchars(strip_tags($this->lat));
            $this->lng = htmlspecialchars(strip_tags($this->lng));
            $this->contrasena = htmlspecialchars(strip_tags($this->contrasena));

            $stmt->bindParam(':idNegocio', $this->idNegocio);
            $stmt->bindParam(':idTipoNegocio', $this->idTipoNegocio);
            $stmt->bindParam(':numeroTienda', $this->numeroTienda);
            $stmt->bindParam(':nombreTienda', $this->nombreTienda);
            $stmt->bindParam(':ruc', $this->ruc);
            $stmt->bindParam(':logo', $this->logo);
            $stmt->bindParam(':correoTienda', $this->correoTienda);
            $stmt->bindParam(':telefonoTienda', $this->telefonoTienda);
            $stmt->bindParam(':direccionTienda', $this->direccionTienda);
            $stmt->bindParam(':descripcionTienda', $this->descripcionTienda);
            $stmt->bindParam(':lat', $this->lat);
            $stmt->bindParam(':lng', $this->lng);
            $stmt->bindParam(':contrasena', $this->contrasena);

            $stmt->execute();
            return $stmt;
        }

        // Editar Tienda
        public function editarTienda(){
            $query = 'CALL editarTienda(:idTienda,:idNegocio,:idTipoNegocio,:numeroTienda,:nombreTienda,
            :ruc,:logo,:correoTienda,:telefonoTienda,:direccionTienda,:descripcionTienda,:lat,:lng);';            
            $stmt = $this->conn->prepare($query);

            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));            
            $this->idNegocio = htmlspecialchars(strip_tags($this->idNegocio));
            $this->idTipoNegocio = htmlspecialchars(strip_tags($this->idTipoNegocio));
            $this->numeroTienda = htmlspecialchars(strip_tags($this->numeroTienda));
            $this->nombreTienda = htmlspecialchars(strip_tags($this->nombreTienda));
            $this->ruc = htmlspecialchars(strip_tags($this->ruc));
            $this->logo = htmlspecialchars(strip_tags($this->logo));
            $this->correoTienda = htmlspecialchars(strip_tags($this->correoTienda));
            $this->telefonoTienda = htmlspecialchars(strip_tags($this->telefonoTienda));
            $this->direccionTienda = htmlspecialchars(strip_tags($this->direccionTienda));
            $this->descripcionTienda = htmlspecialchars(strip_tags($this->descripcionTienda));
            $this->lat = htmlspecialchars(strip_tags($this->lat));
            $this->lng = htmlspecialchars(strip_tags($this->lng));

            $stmt->bindParam(':idTienda', $this->idTienda);
            $stmt->bindParam(':idNegocio', $this->idNegocio);
            $stmt->bindParam(':idTipoNegocio', $this->idTipoNegocio);
            $stmt->bindParam(':numeroTienda', $this->numeroTienda);
            $stmt->bindParam(':nombreTienda', $this->nombreTienda);
            $stmt->bindParam(':ruc', $this->ruc);
            $stmt->bindParam(':logo', $this->logo);
            $stmt->bindParam(':correoTienda', $this->correoTienda);
            $stmt->bindParam(':telefonoTienda', $this->telefonoTienda);
            $stmt->bindParam(':direccionTienda', $this->direccionTienda);
            $stmt->bindParam(':descripcionTienda', $this->descripcionTienda);
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