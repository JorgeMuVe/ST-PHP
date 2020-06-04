<?php
    class Detalle {
        // DB stuff
        private $conn;
        private $table = 'pedidoDetalle';

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // AGREGAR DETALLE DE PEDIDO
        public function agregarPedidoDetalle(){
            $query = 'INSERT INTO pedidoDetalle(idPedido,idTienda,idProducto,cantidadProducto,precioPorUnidad)
            VALUES (:idPedido,:idTienda,:idProducto,:cantidadProducto,:precioPorUnidad)';
            $stmt = $this->conn->prepare($query);

            $this->idPedido = htmlspecialchars(strip_tags($this->idPedido));
            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));
            $this->idProducto = htmlspecialchars(strip_tags($this->idProducto));
            $this->cantidadProducto = htmlspecialchars(strip_tags($this->cantidadProducto));
            $this->precioPorUnidad = htmlspecialchars(strip_tags($this->precioPorUnidad));
            
            $stmt->bindParam(':idPedido',$this->idPedido);
            $stmt->bindParam(':idTienda',$this->idTienda);
            $stmt->bindParam(':idProducto',$this->idProducto);
            $stmt->bindParam(':cantidadProducto',$this->cantidadProducto);
            $stmt->bindParam(':precioPorUnidad',$this->precioPorUnidad);

            // Execute Query
            $stmt->execute();
            return $stmt;
        }

        // LISTAR DETALLES DE PEDIDO DEL CLIENTE
        public function listarDetallePedidoTienda(){
            $queryCantidad = "SELECT COUNT(*) AS cantidadDetalles FROM pedidoDetalle WHERE idTienda=:idTienda AND idPedido=:idPedido;";
            $stmtCantidad = $this->conn->prepare($queryCantidad);

            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));
            $this->idPedido = htmlspecialchars(strip_tags($this->idPedido));
            $stmtCantidad->bindParam(':idTienda', $this->idTienda);
            $stmtCantidad->bindParam(':idPedido', $this->idPedido);
            
            $stmtCantidad->execute();
            
            if($stmtCantidad){
                $queryBusqueda = 'CALL listarDetallePedidoTienda(:idTienda,:idPedido,:inicio,:cantidad)';
                $stmtBusqueda = $this->conn->prepare($queryBusqueda);
                
                $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));
                $this->idPedido = htmlspecialchars(strip_tags($this->idPedido));
                $this->inicio = htmlspecialchars(strip_tags($this->inicio));
                $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));
        
                $stmtBusqueda->bindParam(':idTienda', $this->idTienda);
                $stmtBusqueda->bindParam(':idPedido', $this->idPedido);
                $stmtBusqueda->bindParam(':inicio', $this->inicio);
                $stmtBusqueda->bindParam(':cantidad', $this->cantidad);

                $stmtBusqueda->execute();

                $respuesta = array();
                array_push($respuesta,$stmtCantidad);
                array_push($respuesta,$stmtBusqueda);
                
                return $respuesta;
            } else { return null; }
        }

        // LISTAR DETALLES DE PEDIDO DEL CLIENTE
        public function listarDetallePedidoCliente(){
            $queryCantidad = "SELECT COUNT(*) AS cantidadDetalles FROM pedidoDetalle WHERE idPedido=:idPedido;";
            $stmtCantidad = $this->conn->prepare($queryCantidad);

            $this->idPedido = htmlspecialchars(strip_tags($this->idPedido));
            $stmtCantidad->bindParam(':idPedido', $this->idPedido);
            
            $stmtCantidad->execute();
            
            if($stmtCantidad){
                $queryBusqueda = 'CALL listarDetallePedidoCliente(:idPedido,:inicio,:cantidad)';
                $stmtBusqueda = $this->conn->prepare($queryBusqueda);
                
                $this->idPedido = htmlspecialchars(strip_tags($this->idPedido));
                $this->inicio = htmlspecialchars(strip_tags($this->inicio));
                $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));
        
                $stmtBusqueda->bindParam(':idPedido', $this->idPedido);
                $stmtBusqueda->bindParam(':inicio', $this->inicio);
                $stmtBusqueda->bindParam(':cantidad', $this->cantidad);

                $stmtBusqueda->execute();

                $respuesta = array();
                array_push($respuesta,$stmtCantidad);
                array_push($respuesta,$stmtBusqueda);
                
                return $respuesta;
            } else { return null; }
        }
    }
?>