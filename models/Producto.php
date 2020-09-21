<?php
    class Producto {
        // DB stuff
        private $conn;
        private $table = 'producto';

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // AGREGAR PRODUCTO
        public function agregarProducto(){
            $query = 'INSERT INTO 
            producto (idNegocio,idTipoProducto,nombreProducto,imagenProducto)
            VALUES(:idNegocio,:idTipoProducto,:nombreProducto,:imagenProducto);';
            $stmt = $this->conn->prepare($query);
    
            $this->idNegocio = htmlspecialchars(strip_tags($this->idNegocio));
            $this->idTipoProducto = htmlspecialchars(strip_tags($this->idTipoProducto));
            $this->nombreProducto = htmlspecialchars(strip_tags($this->nombreProducto));
            $this->imagenProducto = htmlspecialchars(strip_tags($this->imagenProducto));

            $stmt->bindParam(':idNegocio', $this->idNegocio);
            $stmt->bindParam(':idTipoProducto', $this->idTipoProducto);
            $stmt->bindParam(':nombreProducto', $this->nombreProducto);
            $stmt->bindParam(':imagenProducto', $this->imagenProducto);

            // Execute Query
            $stmt->execute();
            return $stmt;
        }

        // EDITAR PRODUCTO
        public function editarProducto(){
            $query = 'UPDATE producto SET idTipoProducto=:idTipoProducto,nombreProducto=:nombreProducto,
            imagenProducto=:imagenProducto WHERE idProducto=:idProducto';
            $stmt = $this->conn->prepare($query);
    
            $this->idTipoProducto = htmlspecialchars(strip_tags($this->idTipoProducto));
            $this->nombreProducto = htmlspecialchars(strip_tags($this->nombreProducto));
            $this->imagenProducto = htmlspecialchars(strip_tags($this->imagenProducto));
            $this->idProducto = htmlspecialchars(strip_tags($this->idProducto));

            $stmt->bindParam(':idTipoProducto', $this->idTipoProducto);
            $stmt->bindParam(':nombreProducto', $this->nombreProducto);
            $stmt->bindParam(':imagenProducto', $this->imagenProducto);
            $stmt->bindParam(':idProducto', $this->idProducto);

            // Execute Query
            $stmt->execute();
            return $stmt;
        }

        // BUSCAR PRODUCTO
        public function buscarProducto(){
            $query = 'CALL buscarProducto(:idDepartamento,:idProvincia,:idDistrito,:tipo,:texto,:id,:inicio,:cantidad)';
            $stmt = $this->conn->prepare($query);
            
            $this->idDepartamento = htmlspecialchars(strip_tags($this->idDepartamento));
            $this->idProvincia = htmlspecialchars(strip_tags($this->idProvincia));
            $this->idDistrito = htmlspecialchars(strip_tags($this->idDistrito));
            $this->tipo = htmlspecialchars(strip_tags($this->tipo));
            $this->texto = htmlspecialchars(strip_tags($this->texto));
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->inicio = htmlspecialchars(strip_tags($this->inicio));
            $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));
            
            $stmt->bindParam(':idDepartamento', $this->idDepartamento);
            $stmt->bindParam(':idProvincia', $this->idProvincia);
            $stmt->bindParam(':idDistrito', $this->idDistrito);
            $stmt->bindParam(':tipo', $this->tipo);
            $stmt->bindParam(':texto', $this->texto);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':inicio',$this->inicio);
            $stmt->bindParam(':cantidad',$this->cantidad);

            $stmt->execute();

            return $stmt;
        }

        // LISTAR PRODUCTOS POR NEGOCIO 
        public function listarProductosNegocio(){
            $queryCantidad = 'SELECT COUNT(*) AS cantidadProductos FROM producto WHERE idNegocio = :idNegocio;';
            $stmtCantidad = $this->conn->prepare($queryCantidad);

            $this->idNegocio = htmlspecialchars(strip_tags($this->idNegocio));
            $stmtCantidad->bindParam(':idNegocio', $this->idNegocio);

            $stmtCantidad->execute();
            if($stmtCantidad){
                $queryBusqueda = 'CALL paginadoProductoNegocio(:idNegocio,:inicio,:cantidad)';
                $stmtBusqueda = $this->conn->prepare($queryBusqueda);
                
                $this->idNegocio = htmlspecialchars(strip_tags($this->idNegocio));
                $this->inicio = htmlspecialchars(strip_tags($this->inicio));
                $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));
        
                $stmtBusqueda->bindParam(':idNegocio', $this->idNegocio);
                $stmtBusqueda->bindParam(':inicio', $this->inicio);
                $stmtBusqueda->bindParam(':cantidad', $this->cantidad);

                $stmtBusqueda->execute();

                $respuesta = array();
                array_push($respuesta,$stmtCantidad);
                array_push($respuesta,$stmtBusqueda);
                
                return $respuesta;

            } else { return null; }
        }

        // LISTAR PRODUCTO TIENDA
        public function listarProductosTienda(){
            $queryCantidad = 'SELECT COUNT(*) AS cantidadProductos FROM productoTienda WHERE idTienda = :idTienda;';
            $stmtCantidad = $this->conn->prepare($queryCantidad);

            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));
            $stmtCantidad->bindParam(':idTienda', $this->idTienda);

            $stmtCantidad->execute();
            if($stmtCantidad){
                $queryBusqueda = 'CALL paginadoProductoTienda(:idTienda,:inicio,:cantidad)';
                $stmtBusqueda = $this->conn->prepare($queryBusqueda);
                
                $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));
                $this->inicio = htmlspecialchars(strip_tags($this->inicio));
                $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));
        
                $stmtBusqueda->bindParam(':idTienda', $this->idTienda);
                $stmtBusqueda->bindParam(':inicio', $this->inicio);
                $stmtBusqueda->bindParam(':cantidad', $this->cantidad);

                $stmtBusqueda->execute();

                $respuesta = array();
                array_push($respuesta,$stmtCantidad);
                array_push($respuesta,$stmtBusqueda);
                
                return $respuesta;

            } else { return null; }
        }

        // LISTAR TIPO PRODUCTO
        public function listarTipo(){
            $query = 'SELECT * FROM tipoProducto;';
            $stmt = $this->conn->prepare($query);

            // Execute Query
            $stmt->execute();
            return $stmt;
        }

        // LISTAR UNIDAD PRODUCTO
        public function listarUnidad(){
            $query = 'SELECT * FROM tipoUnidad;';
            $stmt = $this->conn->prepare($query);
            // Execute Query
            $stmt->execute();
            return $stmt;
        }
    }