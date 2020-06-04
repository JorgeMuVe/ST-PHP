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
            $query = 'INSERT INTO producto (idTienda, idTipoProducto, tipoUnidad, nombreProducto, 
            detalleProducto, precioPorUnidad, unidadCantidad, descuentoUnidad, imagenProducto)
            VALUES(:idTienda,:idTipoProducto,:tipoUnidad,:nombreProducto,:detalleProducto,:precioPorUnidad,:unidadCantidad,:descuentoUnidad,:imagenProducto);';
            $stmt = $this->conn->prepare($query);
    
            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));
            $this->idTipoProducto = htmlspecialchars(strip_tags($this->idTipoProducto));
            $this->tipoUnidad = htmlspecialchars(strip_tags($this->tipoUnidad));
            $this->nombreProducto = htmlspecialchars(strip_tags($this->nombreProducto));
            $this->detalleProducto = htmlspecialchars(strip_tags($this->detalleProducto));
            $this->precioPorUnidad = htmlspecialchars(strip_tags($this->precioPorUnidad));
            $this->unidadCantidad = htmlspecialchars(strip_tags($this->unidadCantidad));
            $this->descuentoUnidad = htmlspecialchars(strip_tags($this->descuentoUnidad));
            $this->imagenProducto = htmlspecialchars(strip_tags($this->imagenProducto));

            $stmt->bindParam(':idTienda', $this->idTienda);
            $stmt->bindParam(':idTipoProducto', $this->idTipoProducto);
            $stmt->bindParam(':tipoUnidad', $this->tipoUnidad);
            $stmt->bindParam(':nombreProducto', $this->nombreProducto);
            $stmt->bindParam(':detalleProducto', $this->detalleProducto);
            $stmt->bindParam(':precioPorUnidad', $this->precioPorUnidad);
            $stmt->bindParam(':unidadCantidad', $this->unidadCantidad);
            $stmt->bindParam(':descuentoUnidad', $this->descuentoUnidad);
            $stmt->bindParam(':imagenProducto', $this->imagenProducto);

            // Execute Query
            $stmt->execute();
            return $stmt;
        }

        // EDITAR PRODUCTO
        public function editarProducto(){
            $query = 'UPDATE producto SET idTipoProducto=:idTipoProducto,tipoUnidad=:tipoUnidad,nombreProducto=:nombreProducto,
            detalleProducto=:detalleProducto,precioPorUnidad=:precioPorUnidad,unidadCantidad=:unidadCantidad,
            descuentoUnidad=:descuentoUnidad,imagenProducto=:imagenProducto WHERE idProducto=:idProducto';
            $stmt = $this->conn->prepare($query);
    
            $this->idTipoProducto = htmlspecialchars(strip_tags($this->idTipoProducto));
            $this->tipoUnidad = htmlspecialchars(strip_tags($this->tipoUnidad));
            $this->nombreProducto = htmlspecialchars(strip_tags($this->nombreProducto));
            $this->detalleProducto = htmlspecialchars(strip_tags($this->detalleProducto));
            $this->precioPorUnidad = htmlspecialchars(strip_tags($this->precioPorUnidad));
            $this->unidadCantidad = htmlspecialchars(strip_tags($this->unidadCantidad));
            $this->descuentoUnidad = htmlspecialchars(strip_tags($this->descuentoUnidad));
            $this->imagenProducto = htmlspecialchars(strip_tags($this->imagenProducto));
            $this->idProducto = htmlspecialchars(strip_tags($this->idProducto));

            $stmt->bindParam(':idTipoProducto', $this->idTipoProducto);
            $stmt->bindParam(':tipoUnidad', $this->tipoUnidad);
            $stmt->bindParam(':nombreProducto', $this->nombreProducto);
            $stmt->bindParam(':detalleProducto', $this->detalleProducto);
            $stmt->bindParam(':precioPorUnidad', $this->precioPorUnidad);
            $stmt->bindParam(':unidadCantidad', $this->unidadCantidad);
            $stmt->bindParam(':descuentoUnidad', $this->descuentoUnidad);
            $stmt->bindParam(':imagenProducto', $this->imagenProducto);
            $stmt->bindParam(':idProducto', $this->idProducto);

            // Execute Query
            $stmt->execute();
            return $stmt;
        }

        // BUSCAR PRODUCTO
        public function buscarProducto(){
            $queryCantidad = 'SELECT COUNT(*) as cantidadProductos
            FROM producto p INNER JOIN tipoProducto tp ON p.idTipoProducto = tp.idTipoProducto AND tp.nombreTipoProducto LIKE :tipo
            INNER JOIN tienda t ON p.idTienda = t.idTienda WHERE p.nombreProducto LIKE :texto OR tp.nombreTipoProducto LIKE :texto;';
            $stmtCantidad = $this->conn->prepare($queryCantidad);

            $this->tipo = htmlspecialchars(strip_tags($this->tipo));
            $this->texto = htmlspecialchars(strip_tags($this->texto));
            $stmtCantidad->bindParam(':tipo', $this->tipo);
            $stmtCantidad->bindParam(':texto', $this->texto);

            $stmtCantidad->execute();
            if($stmtCantidad){
                $queryBusqueda = 'CALL buscarProducto(:tipo,:texto,:inicio,:cantidad)';

                $stmtBusqueda = $this->conn->prepare($queryBusqueda);
                
                $this->tipo = htmlspecialchars(strip_tags($this->tipo));
                $this->texto = htmlspecialchars(strip_tags($this->texto));
                $this->inicio = htmlspecialchars(strip_tags($this->inicio));
                $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));

                $stmtBusqueda->bindParam(':tipo', $this->tipo);
                $stmtBusqueda->bindParam(':texto', $this->texto);                
                $stmtBusqueda->bindParam(':inicio',$this->inicio);
                $stmtBusqueda->bindParam(':cantidad',$this->cantidad);

                $stmtBusqueda->execute();

                $respuesta = array();
                array_push($respuesta,$stmtCantidad);
                array_push($respuesta,$stmtBusqueda);
                
                return $respuesta;
            } else { return null; }
        }

        // LISTAR PRODUCTO TIENDA
        public function listarProductosTienda(){
            $queryCantidad = 'SELECT COUNT(*) AS cantidadProductos FROM producto WHERE idTienda = :codigoUsuario;';
            $stmtCantidad = $this->conn->prepare($queryCantidad);

            $this->codigoUsuario = htmlspecialchars(strip_tags($this->codigoUsuario));
            $stmtCantidad->bindParam(':codigoUsuario', $this->codigoUsuario);

            $stmtCantidad->execute();
            if($stmtCantidad){
                $queryBusqueda = 'CALL paginadoProductoTienda(:codigoUsuario,:inicio,:cantidad)';
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