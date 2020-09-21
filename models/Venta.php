<?php
    class Venta {
        // DB stuff
        private $conn;
        private $table = 'venta';

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }
        
        // Agregar Venta
        public function agregarVenta() {
            $query = 'INSERT INTO venta(idTienda,idPedido,estadoPago) VALUES (:idTienda,:idPedido,:estadoPago);';
            $stmt = $this->conn->prepare($query);
            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));
            $this->idPedido = htmlspecialchars(strip_tags($this->idPedido));
            $this->estadoPago = htmlspecialchars(strip_tags($this->estadoPago));
            $stmt->bindParam(':idTienda', $this->idTienda);
            $stmt->bindParam(':idPedido', $this->idPedido);
            $stmt->bindParam(':estadoPago', $this->estadoPago);
            $stmt->execute();
            return $stmt;
        }

        // Listar ventas de Tienda
        public function listaTienda(){
            $queryCantidad = 'SELECT COUNT(*) AS cantidadVentas FROM venta WHERE idTienda = :codigoUsuario';
            $stmtCantidad = $this->conn->prepare($queryCantidad);

            $this->codigoUsuario = htmlspecialchars(strip_tags($this->codigoUsuario));
            $stmtCantidad->bindParam(':codigoUsuario', $this->codigoUsuario);

            $stmtCantidad->execute();
            if($stmtCantidad){
                $queryBusqueda = 'CALL listarPedidoTienda(:codigoUsuario,:inicio,:cantidad)';
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


    }
?>