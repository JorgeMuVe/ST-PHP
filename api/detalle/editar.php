<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Pedido.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Producto
  $pedido = new Pedido($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $pedido->idPedidoDetalle = ""+$data->idPedidoDetalle;
  $pedido->idPuntuacion = ""+$data->idPuntuacion;
  $pedido->idComentario = ""+$data->idComentario;

  // Buscar Usuario
  $result = $pedido->editarPedidoDetalle();

  echo json_encode($result);
?>
