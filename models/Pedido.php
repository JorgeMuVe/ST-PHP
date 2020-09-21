<?php
    class Pedido {
        // DB stuff
        private $conn;
        private $table = 'pedido';

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // AGREGAR PEDIDO
        public function agregarPedido(){
            $query = 'CALL agregarPedido(:tipoUsuario,:codigoUsuario,:idDireccion,:idCobertura,:telefonoReferencia,:correoReferencia,
            :totalProductos,:totalPagar,:fechaRegistro,:estadoPedido)';
            $stmt = $this->conn->prepare($query);
            
            $this->tipoUsuario = htmlspecialchars(strip_tags($this->tipoUsuario));
            $this->codigoUsuario = htmlspecialchars(strip_tags($this->codigoUsuario));
            $this->idDireccion = htmlspecialchars(strip_tags($this->idDireccion));
            $this->idCobertura = htmlspecialchars(strip_tags($this->idCobertura));
            $this->telefonoReferencia = htmlspecialchars(strip_tags($this->telefonoReferencia));
            $this->correoReferencia = htmlspecialchars(strip_tags($this->correoReferencia));
            $this->totalProductos = htmlspecialchars(strip_tags($this->totalProductos));
            $this->totalPagar = htmlspecialchars(strip_tags($this->totalPagar));
            $this->fechaRegistro = htmlspecialchars(strip_tags($this->fechaRegistro));
            $this->estadoPedido = htmlspecialchars(strip_tags($this->estadoPedido));
            
            $stmt->bindParam(':tipoUsuario',$this->tipoUsuario);
            $stmt->bindParam(':codigoUsuario',$this->codigoUsuario);
            $stmt->bindParam(':idDireccion',$this->idDireccion);
            $stmt->bindParam(':idCobertura',$this->idCobertura);
            $stmt->bindParam(':telefonoReferencia',$this->telefonoReferencia);
            $stmt->bindParam(':correoReferencia',$this->correoReferencia);
            $stmt->bindParam(':totalProductos',$this->totalProductos);
            $stmt->bindParam(':totalPagar',$this->totalPagar);
            $stmt->bindParam(':fechaRegistro',$this->fechaRegistro);
            $stmt->bindParam(':estadoPedido',$this->estadoPedido);

            // Execute Query
            $stmt->execute();
            return $stmt;
        }

        // EDITAR IDPUNTUACION Y IDCOMENTARIO DE PEDIDO
        public function editarPedido(){
            $query = 'UPDATE pedido SET idPuntuacion=:idPuntuacion, idComentario=:idComentario WHERE idPedido=:idPedido;';
            $stmt = $this->conn->prepare($query);

            $this->idPedido = htmlspecialchars(strip_tags($this->idPedido));
            $this->idPuntuacion = htmlspecialchars(strip_tags($this->idPuntuacion));
            $this->idComentario = htmlspecialchars(strip_tags($this->idComentario));
            
            $stmt->bindParam(':idPedido',$this->idPedido);
            $stmt->bindParam(':idPuntuacion',$this->idPuntuacion);
            $stmt->bindParam(':idComentario',$this->idComentario);

            // Execute Query
            $stmt->execute();
            return $stmt;
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

        // AGREGAR DETALLE DE PEDIDO
        public function editarPedidoDetalle(){
            $query = 'UPDATE pedidoDetalle SET idPuntuacion=:idPuntuacion, idComentario=:idComentario WHERE idPedidoDetalle=:idPedidoDetalle;';
            $stmt = $this->conn->prepare($query);

            $this->idPedidoDetalle = htmlspecialchars(strip_tags($this->idPedidoDetalle));
            $this->idPuntuacion = htmlspecialchars(strip_tags($this->idPuntuacion));
            $this->idComentario = htmlspecialchars(strip_tags($this->idComentario));
            
            $stmt->bindParam(':idPedidoDetalle',$this->idPedidoDetalle);
            $stmt->bindParam(':idPuntuacion',$this->idPuntuacion);
            $stmt->bindParam(':idComentario',$this->idComentario);

            // Execute Query
            $stmt->execute();
            return $stmt;
        }

        // LISTAR PEDIDOS DEL CLIENTE
        public function listarPedidosCliente(){
            $queryCantidad = "SELECT COUNT(*) AS cantidadPedidos FROM pedido WHERE tipoUsuario='cliente' AND codigoUsuario=:codigoUsuario;";
            $stmtCantidad = $this->conn->prepare($queryCantidad);

            $this->codigoUsuario = htmlspecialchars(strip_tags($this->codigoUsuario));
            $stmtCantidad->bindParam(':codigoUsuario', $this->codigoUsuario);
            
            $stmtCantidad->execute();
            
            if($stmtCantidad){
                $queryBusqueda = 'CALL paginadoPedidoCliente(:codigoUsuario,:inicio,:cantidad)';
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

        // LISTAR PEDIDOS DEL TIENDA
        public function listarPedidosTienda(){
            $queryCantidad = 'SELECT COUNT(*) AS cantidadPedidos FROM venta WHERE idTienda = :codigoUsuario;';
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

        //ACTUALIZAR ESTADO PEDIDO
        public function actualizarEstadoPedido(){
        $query = 'CALL actualizarEstadoPedido(:idPedido,:estadoPedido)';
        $stmt = $this->conn->prepare($query);

        $this->idPedido = htmlspecialchars(strip_tags($this->idPedido));
        $this->estadoPedido = htmlspecialchars(strip_tags($this->estadoPedido));
        $stmt->bindParam(':idPedido', $this->idPedido);
        $stmt->bindParam(':estadoPedido', $this->estadoPedido);

        $stmt->execute();
        return $stmt;
        }  

        //LISTAR DETALLE PEDIDO
        public function listarDetalleCliente(){
        $query = 'CALL listarDetallePedidoCliente(:idPedido, :inicio, :cantidad)';
        $stmt = $this->conn->prepare($query);

        $this->idPedido = htmlspecialchars(strip_tags($this->idPedido));
        $this->inicio = htmlspecialchars(strip_tags($this->inicio));
        $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));
        $stmt->bindParam(':idPedido', $this->idPedido);
        $stmt->bindParam(':inicio', $this->inicio);
        $stmt->bindParam(':cantidad', $this->cantidad);

        $stmt->execute();
        return $stmt;
        }  
    }
?>