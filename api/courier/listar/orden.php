<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../../config/Database.php';
  include_once '../../../models/Courier.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Pedidos
  $courier = new Courier($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $courier->idCourier = $data->idCourier;
  $courier->estado = $data->estado;
  $courier->inicio = $data->inicio;
  $courier->cantidad = $data->cantidad;

  // Buscar Pedidos
  $result = $courier->listarOrdenCourier();

  //Get row count
  $num = $result->rowCount();
  if($num > 0){
    $order_array = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        array_push($order_array,$row);
      }
      echo json_encode($order_array);
  } else { echo json_encode(array('error'=>'Sin registro de Ordenes b!.')); }
?>