<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../../config/Database.php';
  include_once '../../../models/Delivery.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Pedidos
  $delivery = new Delivery($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $delivery->idPedido = $data->idPedido;
  $delivery->inicio = $data->inicio;
  $delivery->cantidad = $data->cantidad;

  // Buscar Pedidos
  $result = $delivery->listarDeliveryDetalle();

  //Get row count
  $num = $result->rowCount();
  if($num > 0){
    $detalle_arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        array_push($detalle_arr,$row);
      }
      echo json_encode($detalle_arr);
  } else { echo json_encode(array('error'=>'Sin registro de Pedidos b!.')); }
?>