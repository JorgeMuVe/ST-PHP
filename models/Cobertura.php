<?php
    class Cobertura{
        private $conn;
        private $table = 'cobertura';

        public function __construct($db){
            $this->conn = $db;
        }

        //AGREGAR COBERTURA
        public function agregarCobertura(){
            $query = 'CALL agregarCobertura(:idTienda,:nombre,:precio,:rango,:color,:lat,:lng)';
            $stmt = $this->conn->prepare($query);

            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->precio = htmlspecialchars(strip_tags($this->precio));
            $this->rango = htmlspecialchars(strip_tags($this->rango));
            $this->color = htmlspecialchars(strip_tags($this->color));
            $this->lat = htmlspecialchars(strip_tags($this->lat));
            $this->lng = htmlspecialchars(strip_tags($this->lng));

            $stmt->bindParam(':idTienda', $this->idTienda);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':precio', $this->precio);
            $stmt->bindParam(':rango', $this->rango);
            $stmt->bindParam(':color', $this->color);
            $stmt->bindParam(':lat', $this->lat);
            $stmt->bindParam(':lng', $this->lng);

            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }

        // EDITAR COBERTURA
        public function editarCobertura(){
            $query = 'CALL editarCobertura(:idCobertura,:nombre,:precio,:rango,:color,:lat,:lng)';
            $stmt = $this->conn->prepare($query);
            $this->idCobertura = htmlspecialchars(strip_tags($this->idCobertura));
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->precio = htmlspecialchars(strip_tags($this->precio));
            $this->rango = htmlspecialchars(strip_tags($this->rango));
            $this->color = htmlspecialchars(strip_tags($this->color));
            $this->lat = htmlspecialchars(strip_tags($this->lat));
            $this->lng = htmlspecialchars(strip_tags($this->lng));

            $stmt->bindParam(':idCobertura', $this->idCobertura);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':precio', $this->precio);
            $stmt->bindParam(':rango', $this->rango);
            $stmt->bindParam(':color', $this->color);
            $stmt->bindParam(':lat', $this->lat);
            $stmt->bindParam(':lng', $this->lng);

            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }
        
        // BORRAR COBERTURA
        public function eliminarCobertura(){
            $query = 'CALL eliminarCobertura(:idCobertura)';
            $stmt = $this->conn->prepare($query);
            $this->idCobertura = htmlspecialchars(strip_tags($this->idCobertura));        
            $stmt->bindParam(':idCobertura', $this->idCobertura);
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }

        // LISTAR COBERTURA POR TIENDA
        public function listarCoberturaTienda(){
            $query = 'CALL listarCoberturaTienda(:idTienda,:inicio,:cantidad)';
            $stmt = $this->conn->prepare($query);
            
            $this->idTienda = htmlspecialchars(strip_tags($this->idTienda));                    
            $this->inicio = htmlspecialchars(strip_tags($this->inicio));                    
            $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));                    
            
            $stmt->bindParam(':idTienda', $this->idTienda);            
            $stmt->bindParam(':inicio', $this->inicio);            
            $stmt->bindParam(':cantidad', $this->cantidad);            
            
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }

        // BUSCAR COBERTURA DE DELIVERYS
        public function buscarCoberturaDelivery(){
            $query = 'CALL buscarCoberturaDelivery(:lat,:lng)';
            $stmt = $this->conn->prepare($query);
            $this->lat = htmlspecialchars(strip_tags($this->lat));                    
            $this->lng = htmlspecialchars(strip_tags($this->lng));                    
            $stmt->bindParam(':lat', $this->lat);            
            $stmt->bindParam(':lng', $this->lng);            
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }

        // BUSCAR COBERTURA POR ID
        public function obtenerCoberturaId(){
            $query = 'CALL obtenerCoberturaId(:idCobertura)';
            $stmt = $this->conn->prepare($query);
            $this->idCobertura = htmlspecialchars(strip_tags($this->idCobertura));                  
            $stmt->bindParam(':idCobertura', $this->idCobertura);         
            $stmt->execute();
            if($stmt){ return $stmt; }
            else { return null; }
        }
    }
?>