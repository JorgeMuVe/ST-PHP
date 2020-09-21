<?php
    class Delivery {
        // DB stuff
        private $conn;
        private $table = 'delivery';

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // CREAR NUEVO SERVICIO DE DELIVERY
        public function agregarServicioDelivery() {
            $query='CALL agregarDelivery(:nombreDelivery,:ruc,:logo,
            :correoDelivery,:telefonoDelivery,:descripcionDelivery,
            :direccionDelivery, :idDepartamento, :idProvincia, :idDistrito,
            :lat, :lng, :contrasena);';            
            $stmt = $this->conn->prepare($query);
            
            $this->nombreDelivery = htmlspecialchars(strip_tags($this->nombreDelivery));
            $this->ruc = htmlspecialchars(strip_tags($this->ruc));
            $this->logo = htmlspecialchars(strip_tags($this->logo));
            $this->correoDelivery = htmlspecialchars(strip_tags($this->correoDelivery));
            $this->telefonoDelivery = htmlspecialchars(strip_tags($this->telefonoDelivery));
            $this->descripcionDelivery = htmlspecialchars(strip_tags($this->descripcionDelivery));
            $this->direccionDelivery = htmlspecialchars(strip_tags($this->direccionDelivery));
            $this->idDepartamento = htmlspecialchars(strip_tags($this->idDepartamento));
            $this->idProvincia = htmlspecialchars(strip_tags($this->idProvincia));
            $this->idDistrito = htmlspecialchars(strip_tags($this->idDistrito));
            $this->lat = htmlspecialchars(strip_tags($this->lat));
            $this->lng = htmlspecialchars(strip_tags($this->lng));
            $this->contrasena = htmlspecialchars(strip_tags($this->contrasena));
            
            $stmt->bindParam(':nombreDelivery', $this->nombreDelivery);
            $stmt->bindParam(':ruc', $this->ruc);
            $stmt->bindParam(':logo', $this->logo);
            $stmt->bindParam(':correoDelivery', $this->correoDelivery);
            $stmt->bindParam(':telefonoDelivery', $this->telefonoDelivery);
            $stmt->bindParam(':descripcionDelivery', $this->descripcionDelivery);
            $stmt->bindParam(':direccionDelivery', $this->direccionDelivery);
            $stmt->bindParam(':idDepartamento', $this->idDepartamento);
            $stmt->bindParam(':idProvincia', $this->idProvincia);
            $stmt->bindParam(':idDistrito', $this->idDistrito);
            $stmt->bindParam(':lat', $this->lat);
            $stmt->bindParam(':lng', $this->lng);
            $stmt->bindParam(':contrasena', $this->contrasena);

            $stmt->execute();
            return $stmt;
        }            

        //LISTAR PRODUCTOS DELIVERY EN COBERTURA PARA EL CLIENTE
         public function listarDeliveryEnCobertura() {
            $query = 'CALL listarDeliveryEnCobertura(:idDistrito, :idProvincia, :idDepartamento)';
            $stmt = $this->conn->prepare($query);
            $this->idDistrito = htmlspecialchars(strip_tags($this->idDistrito));            
            $stmt->bindParam(':idDistrito', $this->idDistrito);            
            $this->idProvincia = htmlspecialchars(strip_tags($this->idProvincia));            
            $stmt->bindParam(':idProvincia', $this->idProvincia);            
            $this->idDepartamento = htmlspecialchars(strip_tags($this->idDepartamento));            
            $stmt->bindParam(':idDepartamento', $this->idDepartamento);            
            $stmt->execute();
            return $stmt;
        }

        //LISTAR SERVICIOS DE DELIVERY 
         public function listarSDelivery(){
            $query = 'CALL listarSDelivery()';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }  

        //AGREGAR ORDEN DE DELIVERY
        public function agregarOrdenDelivery(){
            $query = 'CALL agregarOrdenDelivery(:idPedido,:idTienda,:idCobertura,:estadoPago,:estadoDelivery)';
            $stmt = $this->conn->prepare($query);
            
            $this->idPedido = htmlspecialchars(strip_tags($this->idPedido));
            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));                
            $this->idCobertura = htmlspecialchars(strip_tags($this->idCobertura));
            $this->estadoPago = htmlspecialchars(strip_tags($this->estadoPago));
            $this->estadoDelivery = htmlspecialchars(strip_tags($this->estadoDelivery));

            $stmt->bindParam(':idPedido', $this->idPedido);
            $stmt->bindParam(':idTienda', $this->idTienda);
            $stmt->bindParam(':idCobertura', $this->idCobertura);
            $stmt->bindParam(':estadoPago', $this->estadoPago);
            $stmt->bindParam(':estadoDelivery', $this->estadoDelivery);

            $stmt->execute();
            
            if($stmt){ return $stmt; }
            else { return null; }
        }
                
        //LISTAR DELIVERY ACTIVOS POR SERVICIO DE DELIVERY **
         public function listarDelivery_Est(){
            $query = 'CALL listarDelivery_Est(:idDeliveryTienda, :est)';
            $stmt = $this->conn->prepare($query);
            $this->idDeliveryTienda = htmlspecialchars(strip_tags($this->idDeliveryTienda));            
            $this->est = htmlspecialchars(strip_tags($this->est));            
            $stmt->bindParam(':idDeliveryTienda', $this->idDeliveryTienda);
            $stmt->bindParam(':est', $this->est);
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        } 

        //CAMBIAR ESTADO DE DELIVERY
        public function actualizarEstadoDelivery(){
            $query = 'CALL actualizarEstadoDelivery(:idDelivery, :estadoDelivery)';
            $stmt = $this->conn->prepare($query);
            $this->idDelivery = htmlspecialchars(strip_tags($this->idDelivery));
            $this->estadoDelivery = htmlspecialchars(strip_tags($this->estadoDelivery));
            $stmt->bindParam(':idDelivery', $this->idDelivery);            
            $stmt->bindParam(':estadoDelivery', $this->estadoDelivery);
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }

        //OBTENER ESTADO DELIVERY **
        public function obtenerEstadoDelivery(){
            $query = 'CALL obtenerEstadoDelivery(:idDelivery)';
            $stmt = $this->conn->prepare($query);
            $this->idDelivery = htmlspecialchars(strip_tags($this->idDelivery));            
            $stmt->bindParam(':idDelivery', $this->idDelivery);
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }

        //CANCELAR DELIVERY
        public function cancelarDelivery(){
            $query = 'CALL cancelarDelivery(:idDelivery)';
            $stmt = $this->conn->prepare($query);
            $this->idDelivery = htmlspecialchars(strip_tags($this->idDelivery));            
            $stmt->bindParam(':idDelivery', $this->idDelivery);
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        } 

        //LISTAR SERVICIO DELIVERY POR TIENDA
        public function listarServicioTiendaDelivery(){
            $query = 'CALL listarServicioTiendaDelivery(:idTienda)';
            $stmt = $this->conn->prepare($query);
            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));            
            $stmt->bindParam(':idTienda', $this->idTienda);
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        } 

        //LISTAR DETALLE PEDIDO
        public function listarDeliveryDetalle(){
        $query = 'CALL listarDeliveryDetalle(:idPedido, :inicio, :cantidad)';
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