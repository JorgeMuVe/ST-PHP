<?php
    class Usuario {
        // DB stuff
        private $conn;
        private $table = 'usuario';

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // Agregar Usuario
        public function agregarUsuario() {
            $query='CALL agregarUsuario(:registroNacional,:nombreCompleto,:apellidoPaterno,:apellidoMaterno,:telefonoCliente,:imagenCliente,:nombreUsuario,:contrasena,:tipoUsuario);';
            $stmt = $this->conn->prepare($query);
            $this->registroNacional = htmlspecialchars(strip_tags($this->registroNacional));
            $this->nombreCompleto = htmlspecialchars(strip_tags($this->nombreCompleto));
            $this->apellidoPaterno = htmlspecialchars(strip_tags($this->apellidoPaterno));
            $this->apellidoMaterno = htmlspecialchars(strip_tags($this->apellidoMaterno));
            $this->telefonoCliente = htmlspecialchars(strip_tags($this->telefonoCliente));
            $this->imagenCliente = htmlspecialchars(strip_tags($this->imagenCliente));            
            $this->nombreUsuario = htmlspecialchars(strip_tags($this->nombreUsuario));
            $this->contrasena = htmlspecialchars(strip_tags($this->contrasena));
            $this->tipoUsuario = htmlspecialchars(strip_tags($this->tipoUsuario));
            
            $stmt->bindParam(':registroNacional', $this->registroNacional);
            $stmt->bindParam(':nombreCompleto', $this->nombreCompleto);
            $stmt->bindParam(':apellidoPaterno', $this->apellidoPaterno);
            $stmt->bindParam(':apellidoMaterno', $this->apellidoMaterno);
            $stmt->bindParam(':telefonoCliente', $this->telefonoCliente);
            $stmt->bindParam(':imagenCliente', $this->imagenCliente);
            $stmt->bindParam(':nombreUsuario', $this->nombreUsuario);
            $stmt->bindParam(':contrasena', $this->contrasena);
            $stmt->bindParam(':tipoUsuario', $this->tipoUsuario);
            $stmt->execute();
            return $stmt;
        }

        // Agregar Usuario
        public function cambiarContrasena() {
            $query='CALL cambiarContrasena(:idUsuario,:contrasena);';
            $stmt = $this->conn->prepare($query);
            $this->idUsuario = htmlspecialchars(strip_tags($this->idUsuario));
            $this->contrasena = htmlspecialchars(strip_tags($this->contrasena));
            
            $stmt->bindParam(':idUsuario', $this->idUsuario);
            $stmt->bindParam(':contrasena', $this->contrasena);
            $stmt->execute();
            return $stmt;
        }

        // Ingresar Verificar Usuario
        public function ingresarSistema(){
            $query = 'CALL ingresarSistema(:nombreUsuario,:contrasena,:tipoUsuario);';
            $stmt = $this->conn->prepare($query);
            $this->nombreUsuario = htmlspecialchars(strip_tags($this->nombreUsuario));
            $this->contrasena = htmlspecialchars(strip_tags($this->contrasena));
            $this->tipoUsuario = htmlspecialchars(strip_tags($this->tipoUsuario));
            $stmt->bindParam(':nombreUsuario', $this->nombreUsuario);
            $stmt->bindParam(':contrasena', $this->contrasena);
            $stmt->bindParam(':tipoUsuario', $this->tipoUsuario);
            $stmt->execute();
            return $stmt;
        }

        // Buscar un Usuario Cliente
        public function buscarUsuarioCliente(){
            $query = 'CALL buscarUsuarioCliente(:codigoUsuario);';
            $stmt = $this->conn->prepare($query);
            $this->codigoUsuario = htmlspecialchars(strip_tags($this->codigoUsuario));
            $stmt->bindParam(':codigoUsuario', $this->codigoUsuario);
            $stmt->execute();
            return $stmt;
        }

        // Buscar un Usuario Negocio
        public function buscarUsuarioNegocio(){
            $query = 'CALL buscarUsuarioNegocio(:codigoUsuario);';
            $stmt = $this->conn->prepare($query);
            $this->codigoUsuario = htmlspecialchars(strip_tags($this->codigoUsuario));
            $stmt->bindParam(':codigoUsuario', $this->codigoUsuario);
            $stmt->execute();
            return $stmt;
        }

        // Buscar un Usuario Tienda
        public function buscarUsuarioTienda(){
            $query = 'CALL buscarUsuarioTienda(:codigoUsuario);';
            $stmt = $this->conn->prepare($query);
            $this->codigoUsuario = htmlspecialchars(strip_tags($this->codigoUsuario));
            $stmt->bindParam(':codigoUsuario', $this->codigoUsuario);
            $stmt->execute();
            return $stmt;
        }

        // LISTAR USUARIOS PARA ADMIN
        public function listarUsuarios(){
            $queryCantidad = 'SELECT COUNT(*) AS cantidadUsuarios FROM usuario;';
            $stmtCantidad = $this->conn->prepare($queryCantidad);
            $stmtCantidad->execute();
            if($stmtCantidad){
                $queryBusqueda = 'CALL listarUsuarios(:inicio,:cantidad)';
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
    }
?>