<?php
    class Categoria{
        private $conn;
        private $table = 'categoria';

        public function __construct($db){
            $this->conn = $db;
        }

        // LISTAR TIENDAS DE UN NEGOCIO QUE SEAN DE CIERTO TIPO
        public function listarTiendasPorTipoNegocio(){
            $queryCantidad = 'SELECT COUNT(*) AS cantidadTiendas FROM tienda WHERE idNegocio = :idNegocio AND idTipoNegocio = :idTipoNegocio;';
            $stmtCantidad = $this->conn->prepare($queryCantidad);
            $this->idNegocio = htmlspecialchars(strip_tags($this->idNegocio));
            $this->idTipoNegocio = htmlspecialchars(strip_tags($this->idTipoNegocio));
            $stmtCantidad->bindParam(':idNegocio', $this->idNegocio);
            $stmtCantidad->bindParam(':idTipoNegocio', $this->idTipoNegocio);

            $stmtCantidad->execute();
            if($stmtCantidad){
                $queryBusqueda = 'CALL listarTiendasPorTipoNegocio(:idNegocio,:idTipoNegocio,:inicio,:cantidad)';
                $stmtBusqueda = $this->conn->prepare($queryBusqueda);
                $this->idNegocio = htmlspecialchars(strip_tags($this->idNegocio));
                $this->idTipoNegocio = htmlspecialchars(strip_tags($this->idTipoNegocio));
                $this->inicio = htmlspecialchars(strip_tags($this->inicio));
                $this->cantidad = htmlspecialchars(strip_tags($this->cantidad));
                $stmtBusqueda->bindParam(':idNegocio', $this->idNegocio);
                $stmtBusqueda->bindParam(':idTipoNegocio', $this->idTipoNegocio);
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