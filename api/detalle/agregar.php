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

  $pedido->idPedido = ""+$data->idPedido;
  $pedido->idTienda = ""+$data->idTienda;
  $pedido->idProducto = ""+$data->idProducto;
  $pedido->cantidadProducto = ""+$data->cantidadProducto;
  $pedido->precioPorUnidad = ""+$data->precioPorUnidad;

  // Buscar Usuario
  $result = $pedido->agregarPedidoDetalle();

  echo json_encode($result);
?>
