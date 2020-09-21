<?php
    class ProductoTienda{
        private $conn;
        private $table = 'productoTienda';

        public function __construct($db){
            $this->conn = $db;
        }

        // AGREGAR PRODUCTO A TIENDA
        public function agregarProductoTienda(){
            $query = 'CALL agregarProductoTienda(:idTienda,:idProducto)';
            $stmt = $this->conn->prepare($query);
    
            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));
            $this->idProducto = htmlspecialchars(strip_tags($this->idProducto));

            $stmt->bindParam(':idTienda', $this->idTienda);
            $stmt->bindParam(':idProducto', $this->idProducto);

            // Execute Query
            $stmt->execute();
            return $stmt;
        }

        // RETIRAR PRODUCTO A TIENDA
        public function retirarProductoTienda(){
            $query = 'CALL retirarProductoTienda(:idTienda,:idProducto)';
            $stmt = $this->conn->prepare($query);
    
            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));
            $this->idProducto = htmlspecialchars(strip_tags($this->idProducto));

            $stmt->bindParam(':idTienda', $this->idTienda);
            $stmt->bindParam(':idProducto', $this->idProducto);

            // Execute Query
            $stmt->execute();
            return $stmt;
        }

        
        // EDITAR PRODUCTO EN TIENDA
        public function agregarProductoEnTienda(){
            $query = 'CALL agregarProductoEnTienda(:idNegocio,:idTienda,:idTipoProducto,:nombreProducto,:imagenProducto,:detalleProducto,:precioPorUnidad,:unidadCantidad,:tipoUnidad,:descuentoUnidad,:stockDisponible,:stockMinimo);';
            $stmt = $this->conn->prepare($query);

            $this->idNegocio = htmlspecialchars(strip_tags($this->idNegocio));
            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));
            $this->idTipoProducto = htmlspecialchars(strip_tags($this->idTipoProducto));
            $this->nombreProducto = htmlspecialchars(strip_tags($this->nombreProducto));
            $this->imagenProducto = htmlspecialchars(strip_tags($this->imagenProducto));
            $this->detalleProducto = htmlspecialchars(strip_tags($this->detalleProducto));
            $this->precioPorUnidad = htmlspecialchars(strip_tags($this->precioPorUnidad));
            $this->unidadCantidad = htmlspecialchars(strip_tags($this->unidadCantidad));
            $this->tipoUnidad = htmlspecialchars(strip_tags($this->tipoUnidad));
            $this->descuentoUnidad = htmlspecialchars(strip_tags($this->descuentoUnidad));
            $this->stockDisponible = htmlspecialchars(strip_tags($this->stockDisponible));
            $this->stockMinimo = htmlspecialchars(strip_tags($this->stockMinimo));

            $stmt->bindParam(':idNegocio', $this->idNegocio);
            $stmt->bindParam(':idTienda', $this->idTienda);
            $stmt->bindParam(':idTipoProducto', $this->idTipoProducto);
            $stmt->bindParam(':nombreProducto', $this->nombreProducto);
            $stmt->bindParam(':imagenProducto', $this->imagenProducto);
            $stmt->bindParam(':detalleProducto', $this->detalleProducto);
            $stmt->bindParam(':precioPorUnidad', $this->precioPorUnidad);
            $stmt->bindParam(':unidadCantidad', $this->unidadCantidad);
            $stmt->bindParam(':tipoUnidad', $this->tipoUnidad);
            $stmt->bindParam(':descuentoUnidad', $this->descuentoUnidad);
            $stmt->bindParam(':stockDisponible', $this->stockDisponible);
            $stmt->bindParam(':stockMinimo', $this->stockMinimo);

            // Execute Query
            $stmt->execute();
            return $stmt;
        }

        // EDITAR PRODUCTO TIENDA
        public function editarProductoTienda(){
            $query = 'CALL editarProductoTienda(:idProducto,:idProductoTienda,:idTipoProducto,:nombreProducto,:imagenProducto,:detalleProducto,:precioPorUnidad,:unidadCantidad,:tipoUnidad,:descuentoUnidad,:stockDisponible,:stockMinimo);';
            $stmt = $this->conn->prepare($query);

            $this->idProducto = htmlspecialchars(strip_tags($this->idProducto));
            $this->idProductoTienda = htmlspecialchars(strip_tags($this->idProductoTienda));
            $this->idTipoProducto = htmlspecialchars(strip_tags($this->idTipoProducto));
            $this->nombreProducto = htmlspecialchars(strip_tags($this->nombreProducto));
            $this->imagenProducto = htmlspecialchars(strip_tags($this->imagenProducto));
            $this->detalleProducto = htmlspecialchars(strip_tags($this->detalleProducto));
            $this->precioPorUnidad = htmlspecialchars(strip_tags($this->precioPorUnidad));
            $this->unidadCantidad = htmlspecialchars(strip_tags($this->unidadCantidad));
            $this->tipoUnidad = htmlspecialchars(strip_tags($this->tipoUnidad));
            $this->descuentoUnidad = htmlspecialchars(strip_tags($this->descuentoUnidad));
            $this->stockDisponible = htmlspecialchars(strip_tags($this->stockDisponible));
            $this->stockMinimo = htmlspecialchars(strip_tags($this->stockMinimo));

            $stmt->bindParam(':idProducto', $this->idProducto);
            $stmt->bindParam(':idProductoTienda', $this->idProductoTienda);
            $stmt->bindParam(':idTipoProducto', $this->idTipoProducto);
            $stmt->bindParam(':nombreProducto', $this->nombreProducto);
            $stmt->bindParam(':imagenProducto', $this->imagenProducto);
            $stmt->bindParam(':detalleProducto', $this->detalleProducto);
            $stmt->bindParam(':precioPorUnidad', $this->precioPorUnidad);
            $stmt->bindParam(':unidadCantidad', $this->unidadCantidad);
            $stmt->bindParam(':tipoUnidad', $this->tipoUnidad);
            $stmt->bindParam(':descuentoUnidad', $this->descuentoUnidad);
            $stmt->bindParam(':stockDisponible', $this->stockDisponible);
            $stmt->bindParam(':stockMinimo', $this->stockMinimo);

            // Execute Query
            $stmt->execute();
            return $stmt;
        }

        // LISTAR TIENDAS DE UN NEGOCIO Q TENGAN EL PRODUCTO
        public function listarTiendasProducto(){
          $queryBusqueda = 'CALL listarTiendasProducto(:idNegocio,:idProducto)';
          $stmtBusqueda = $this->conn->prepare($queryBusqueda);
          
          $this->idNegocio = htmlspecialchars(strip_tags($this->idNegocio));
          $this->idProducto = htmlspecialchars(strip_tags($this->idProducto));
  
          $stmtBusqueda->bindParam(':idNegocio', $this->idNegocio);
          $stmtBusqueda->bindParam(':idProducto', $this->idProducto);

          $stmtBusqueda->execute();          
          return $stmtBusqueda;
        }
    }
?>