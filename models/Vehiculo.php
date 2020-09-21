<?php
    class Vehiculo {
        // DB stuff
        private $conn;
        private $table = 'vehiculo';

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // AGREGAR VEHICULO 
        public function agregarVehiculo(){
        $query = 'CALL agregarVehiculo(:placaVehiculo, :idTipoVehiculo, :idEmpDelivery)';
        $stmt = $this->conn->prepare($query);

        $this->placaVehiculo = htmlspecialchars(strip_tags($this->placaVehiculo));
        $this->idTipoVehiculo = htmlspecialchars(strip_tags($this->idTipoVehiculo));
        $this->idEmpDelivery = htmlspecialchars(strip_tags($this->idEmpDelivery));
        
        $stmt->bindParam(':placaVehiculo', $this->placaVehiculo);
        $stmt->bindParam(':idTipoVehiculo', $this->idTipoVehiculo);
        $stmt->bindParam(':idEmpDelivery', $this->idEmpDelivery);
        
        $stmt->execute();
        return $stmt;
        }
        
        // EDITAR VEHICULO 
        public function editarVehiculo(){
        $query = 'CALL editarVehiculo(:idVehiculo, :placaVehiculo)';
        $stmt = $this->conn->prepare($query);

        $this->idVehiculo = htmlspecialchars(strip_tags($this->idVehiculo));
        $this->placaVehiculo = htmlspecialchars(strip_tags($this->placaVehiculo));
        
        $stmt->bindParam(':idVehiculo', $this->idVehiculo);
        $stmt->bindParam(':placaVehiculo', $this->placaVehiculo);

        $stmt->execute();
        return $stmt;
        }

        //LISTAR VEHICULO
        public function listarVehiculo(){
        $query = 'CALL listarVehiculo(:idEmpDelivery)';
        $stmt = $this->conn->prepare($query);

        $this->idEmpDelivery = htmlspecialchars(strip_tags($this->idEmpDelivery));
        $stmt->bindParam(':idEmpDelivery', $this->idEmpDelivery);
        
        $stmt->execute();
        return $stmt;
        } 

        //ACTUALIZAR ESTADO COURIER
        public function actualizarEstadoVehiculo(){
        $query = 'CALL actualizarEstadoVehiculo(:idVehiculo,:estadoVehiculo)';
        $stmt = $this->conn->prepare($query);

        $this->idVehiculo = htmlspecialchars(strip_tags($this->idVehiculo));
        $this->estadoVehiculo = htmlspecialchars(strip_tags($this->estadoVehiculo));
        $stmt->bindParam(':idVehiculo', $this->idVehiculo);
        $stmt->bindParam(':estadoVehiculo', $this->estadoVehiculo);

        $stmt->execute();
        return $stmt;
        }   

        //ASIGNAR VEHICULO
        public function asignarVehiculo(){
        $query = 'CALL asignarVehiculo(:idCourier,:idVehiculo)';
        $stmt = $this->conn->prepare($query);

        $this->idCourier = htmlspecialchars(strip_tags($this->idCourier));
        $this->idVehiculo = htmlspecialchars(strip_tags($this->idVehiculo));
        $stmt->bindParam(':idCourier', $this->idCourier);
        $stmt->bindParam(':idVehiculo', $this->idVehiculo);

        $stmt->execute();
        return $stmt;
        }

        //ASIGNAR VEHICULO
        public function quitarAsignacionVehiculo(){
        $query = 'CALL quitarAsignacionVehiculo(:idVehiculo, :idCourier)';
        $stmt = $this->conn->prepare($query);
        
        $this->idVehiculo = htmlspecialchars(strip_tags($this->idVehiculo));
        $this->idCourier = htmlspecialchars(strip_tags($this->idCourier));
        $stmt->bindParam(':idVehiculo', $this->idVehiculo);
        $stmt->bindParam(':idCourier', $this->idCourier);

        $stmt->execute();
        return $stmt;
        }

        //LISTAR ASIGNACION DE VEHICULOS POR TIENDA
        public function listarAsignaciones(){
            $query = 'CALL listarAsignacionesVehiculo(:idEmpDelivery)';
            $stmt = $this->conn->prepare($query);

            $this->idEmpDelivery = htmlspecialchars(strip_tags($this->idEmpDelivery));
            $stmt->bindParam(':idEmpDelivery', $this->idEmpDelivery);

            $stmt->execute();
            return $stmt;
        }
    }
?>  