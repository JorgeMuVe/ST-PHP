<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../../config/Database.php';
  include_once '../../../models/Detalle.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Producto
  $detalle = new Detalle($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $detalle->idTienda = ""+$data->idTienda;
  $detalle->idPedido = ""+$data->idPedido;
  $detalle->inicio = ""+$data->inicio;
  $detalle->cantidad = ""+$data->cantidad;
  
  // Bucar detalles Pedido
    $result = $detalle->listarDetallePedidoTienda();
    $respuesta = array();
    
    //Get row count
    $numCantidad = $result[0]->rowCount();
    if($numCantidad > 0){
        $cantidadDetalles = $result[0]->fetch(PDO::FETCH_ASSOC);
        $numBusqueda = $result[1]->rowCount();
        if($numBusqueda > 0){
            $listaDetalles = array();
            try {
              while($row = $result[1]->fetch(PDO::FETCH_ASSOC)){
                  extract($row);
                  array_push($listaDetalles,$row);
              }
              echo json_encode( array(
                  'cantidadDetalles'=>$cantidadDetalles["cantidadDetalles"],
                  'listaDetalles'=>$listaDetalles
              ));
            } catch (PDOException $e) {
                echo json_encode(array('error'=>$e->getMessage()));  
            }
        } else { echo json_encode(array('error'=>'Sin registro de Detalles!.')); }
    } else { echo json_encode(array('error'=>'Sin registro de Detalles!.')); }
?>
