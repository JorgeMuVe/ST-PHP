<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../../config/Database.php';
  include_once '../../../models/Pedido.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Pedidos
  $pedido = new Pedido($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $pedido->codigoUsuario = ""+$data->codigoUsuario;
  $pedido->inicio = ""+$data->inicio;
  $pedido->cantidad = ""+$data->cantidad;

  // Buscar Pedidos
  $result = $pedido->listarPedidosCliente();

  //Get row count
  $numCantidad = $result[0]->rowCount();
  if($numCantidad > 0){
    $cantidadPedidos = $result[0]->fetch(PDO::FETCH_ASSOC);
    $numBusqueda = $result[1]->rowCount();
    if($numBusqueda > 0){
      $listaPedidos = array();
      try {
        while($row = $result[1]->fetch(PDO::FETCH_ASSOC)){
          extract($row);
          array_push($listaPedidos,$row);
        }
        echo json_encode( array(
          'cantidadPedidos'=>$cantidadPedidos["cantidadPedidos"],
          'listaPedidos'=>$listaPedidos
        ));
      } catch (PDOException $e) {
        echo json_encode(array('error'=>$e->getMessage()));  
      }    
    } else { echo json_encode(array('error'=>'Sin registro de Pedidos c!.')); }
  } else { echo json_encode(array('error'=>'Sin registro de Pedidos b!.')); }
?>
