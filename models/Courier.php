<?php
    class Courier {
        // DB stuff
        private $conn;
        private $table = 'courier';

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        //AGREGAR COURIER
        public function agregarCourier(){
        $query = 'CALL agregarCourier(:idEmpDelivery, :registroNacional, :nombreCompleto, 
        :apellidoPaterno, :apellidoMaterno, :correoCourier, :telefonoCourier, :password)';
        $stmt = $this->conn->prepare($query);

        $this->idEmpDelivery = htmlspecialchars(strip_tags($this->idEmpDelivery));
        $this->registroNacional = htmlspecialchars(strip_tags($this->registroNacional));
        $this->nombreCompleto = htmlspecialchars(strip_tags($this->nombreCompleto));
        $this->apellidoPaterno = htmlspecialchars(strip_tags($this->apellidoPaterno));
        $this->apellidoMaterno = htmlspecialchars(strip_tags($this->apellidoMaterno));
        $this->correoCourier = htmlspecialchars(strip_tags($this->correoCourier));
        $this->telefonoCourier = htmlspecialchars(strip_tags($this->telefonoCourier));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $stmt->bindParam(':idEmpDelivery', $this->idEmpDelivery);
        $stmt->bindParam(':registroNacional', $this->registroNacional);
        $stmt->bindParam(':nombreCompleto', $this->nombreCompleto);
        $stmt->bindParam(':apellidoPaterno', $this->apellidoPaterno);
        $stmt->bindParam(':apellidoMaterno', $this->apellidoMaterno);
        $stmt->bindParam(':correoCourier', $this->correoCourier);
        $stmt->bindParam(':telefonoCourier', $this->telefonoCourier);
        $stmt->bindParam(':password', $this->password);

        $stmt->execute();
        if($stmt){ return $stmt; }
        else { return null; }
        } 

        //EDITAR COURIER
        public function editarCourier(){
        $query = 'CALL editarCourier(:idCourier, :registroNacional, :nombreCompleto, 
        :apellidoPaterno, :apellidoMaterno, :telefonoCourier)';
        $stmt = $this->conn->prepare($query);

        $this->idCourier = htmlspecialchars(strip_tags($this->idCourier));
        $this->registroNacional = htmlspecialchars(strip_tags($this->registroNacional));
        $this->nombreCompleto = htmlspecialchars(strip_tags($this->nombreCompleto));
        $this->apellidoPaterno = htmlspecialchars(strip_tags($this->apellidoPaterno));
        $this->apellidoMaterno = htmlspecialchars(strip_tags($this->apellidoMaterno));        
        $this->telefonoCourier = htmlspecialchars(strip_tags($this->telefonoCourier));        

        $stmt->bindParam(':idCourier', $this->idCourier);
        $stmt->bindParam(':registroNacional', $this->registroNacional);
        $stmt->bindParam(':nombreCompleto', $this->nombreCompleto);
        $stmt->bindParam(':apellidoPaterno', $this->apellidoPaterno);
        $stmt->bindParam(':apellidoMaterno', $this->apellidoMaterno);
        $stmt->bindParam(':telefonoCourier', $this->telefonoCourier);

        $stmt->execute();
        if($stmt){ return $stmt; }
        else { return null; }
        }    

        //LISTAR COURIER
        public function listarCourier(){
        $query = 'CALL listarCourier(:idEmpDelivery,:dispCourier)';
        $stmt = $this->conn->prepare($query);

        $this->idEmpDelivery = htmlspecialchars(strip_tags($this->idEmpDelivery));
        $this->dispCourier = htmlspecialchars(strip_tags($this->dispCourier));
        $stmt->bindParam(':idEmpDelivery', $this->idEmpDelivery);
        $stmt->bindParam(':dispCourier', $this->dispCourier);

        $stmt->execute();
        return $stmt;
        } 

        //LISTAR ORDENES COURIER
        public function listarOrdenCourier(){
        $query = 'CALL listarOrdenCourier(:idCourier, :estado, :inicio, :cantidad)';
        $stmt = $this->conn->prepare($query);

        $this->idCourier = htmlspecialchars(strip_tags($this->idCourier));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->inicio = htmlspecialchars(strip_tags($this->inicio));
        $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));

        $stmt->bindParam(':idCourier', $this->idCourier);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':inicio', $this->inicio);
        $stmt->bindParam(':cantidad', $this->cantidad);

        $stmt->execute();
        return $stmt;
        }

        //ACTUALIZAR ESTADO COURIER
        public function actualizarEstadoCourier(){
        $query = 'CALL actualizarEstadoCourier(:idCourier,:estadoCourier)';
        $stmt = $this->conn->prepare($query);

        $this->idCourier = htmlspecialchars(strip_tags($this->idCourier));
        $this->estadoCourier = htmlspecialchars(strip_tags($this->estadoCourier));
        $stmt->bindParam(':idCourier', $this->idCourier);
        $stmt->bindParam(':estadoCourier', $this->estadoCourier);

        $stmt->execute();
        return $stmt;
        }   

        //ACTUALIZAR DISPONIBILIDAD COURIER
        public function actualizarDispCourier(){
        $query = 'CALL actualizarDispCourier(:idCourier,:dispCourier)';
        $stmt = $this->conn->prepare($query);

        $this->idCourier = htmlspecialchars(strip_tags($this->idCourier));
        $this->dispCourier = htmlspecialchars(strip_tags($this->dispCourier));
        $stmt->bindParam(':idCourier', $this->idCourier);
        $stmt->bindParam(':dispCourier', $this->dispCourier);

        $stmt->execute();
        return $stmt;
        }   

        //ASIGNAR COURIER
        public function asignarCourier(){
        $query = 'CALL asignarCourier(:idPedido,:idCourier)';
        $stmt = $this->conn->prepare($query);

        $this->idPedido = htmlspecialchars(strip_tags($this->idPedido));
        $this->idCourier = htmlspecialchars(strip_tags($this->idCourier));
        $stmt->bindParam(':idPedido', $this->idPedido);
        $stmt->bindParam(':idCourier', $this->idCourier);

        $stmt->execute();
        return $stmt;
        }

        //COURIER(DATOS VEHICULO Y TIENDA)
        public function listarCourierVehiculoTienda(){
        $query = 'CALL listarCourierVehiculoTienda(:idCourier)';
        $stmt = $this->conn->prepare($query);
        
        $this->idCourier = htmlspecialchars(strip_tags($this->idCourier));
        $stmt->bindParam(':idCourier', $this->idCourier);

        $stmt->execute();
        return $stmt;
        } 

        //COURIER(DATOS VEHICULO Y TIENDA)
        public function listarCourierEstado(){
        $query = 'CALL listarCourierEstado(:idCourier)';
        $stmt = $this->conn->prepare($query);
        
        $this->idCourier = htmlspecialchars(strip_tags($this->idCourier));
        $stmt->bindParam(':idCourier', $this->idCourier);

        $stmt->execute();
        return $stmt;
        }
      
    }
?>  