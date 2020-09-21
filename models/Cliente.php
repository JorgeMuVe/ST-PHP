<?php
    class Cliente {
        // DB stuff
        private $conn;
        private $table = 'cliente';

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // Editar Cliente

        public function editarCliente() {
            $query='CALL editarCliente(:idCliente,:registroNacional,:nombreCompleto,
            :apellidoPaterno,:apellidoMaterno,:telefonoCliente,:imagenCliente);';
            $stmt = $this->conn->prepare($query);
            
            $this->idCliente = htmlspecialchars(strip_tags($this->idCliente));
            $this->registroNacional = htmlspecialchars(strip_tags($this->registroNacional));
            $this->nombreCompleto = htmlspecialchars(strip_tags($this->nombreCompleto));
            $this->apellidoPaterno = htmlspecialchars(strip_tags($this->apellidoPaterno));
            $this->apellidoMaterno = htmlspecialchars(strip_tags($this->apellidoMaterno));
            $this->telefonoCliente = htmlspecialchars(strip_tags($this->telefonoCliente));
            $this->imagenCliente = htmlspecialchars(strip_tags($this->imagenCliente));

            $stmt->bindParam(':idCliente', $this->idCliente);
            $stmt->bindParam(':registroNacional', $this->registroNacional);
            $stmt->bindParam(':nombreCompleto', $this->nombreCompleto);
            $stmt->bindParam(':apellidoPaterno', $this->apellidoPaterno);
            $stmt->bindParam(':apellidoMaterno', $this->apellidoMaterno);
            $stmt->bindParam(':telefonoCliente', $this->telefonoCliente);
            $stmt->bindParam(':imagenCliente', $this->imagenCliente);

            $stmt->execute();
            return $stmt;
        }

        // LISTAR CLIENTES PARA ADMIN
        public function listarClientes(){
            $queryCantidad = 'SELECT COUNT(*) AS cantidadClientes FROM cliente;';
            $stmtCantidad = $this->conn->prepare($queryCantidad);
            $stmtCantidad->execute();
            if($stmtCantidad){
                $queryBusqueda = 'CALL listarClientes(:inicio,:cantidad)';
                $stmtBusqueda = $this->conn->prepare($queryBusqueda);
                
                $this->inicio = htmlspecialchars(strip_tags($this->inicio));
                $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));
        
                $stmtBusqueda->bindParam(':inicio', $this->inicio);
                $stmtBusqueda->bindParam(':cantidad', $this->cantidad);

                $stmtBusqueda->execute();

                $respuesta = array();
                array_push($respuesta,$stmtCantidad);
                array_push($respuesta,$stmtBusqueda);
                
                return $respuesta;

            } else { return null; }
        }   

         // DATOS CLIENTES
        public function datosCliente(){
            $query = 'SELECT * FROM cliente WHERE idCliente = :idCliente';
            $stmt = $this->conn->prepare($query);

            $this->idCliente = htmlspecialchars(strip_tags($this->idCliente));
            $stmt->bindParam(':idCliente', $this->idCliente);

            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }

        // Cambiar Imagen Cliente
        public function cambiarImagenCliente(){
            $query = 'UPDATE cliente SET imagenCliente=:imagenCliente, marcador=:marcador WHERE idCliente=:idCliente;';
            $stmt = $this->conn->prepare($query);
            
            $this->idCliente = htmlspecialchars(strip_tags($this->idCliente));
            $this->imagenCliente = htmlspecialchars(strip_tags($this->imagenCliente));
            $this->marcador = htmlspecialchars(strip_tags($this->marcador));
            
            $stmt->bindParam(':idCliente', $this->idCliente);
            $stmt->bindParam(':imagenCliente', $this->imagenCliente);
            $stmt->bindParam(':marcador', $this->marcador);
            
            $stmt->execute();
            return $stmt;
        }
    }
?>