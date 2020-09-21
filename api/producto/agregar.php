<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Producto.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Producto
  $producto = new Producto($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));
  
  $producto->idNegocio = ""+$data->idNegocio;
  $producto->idTipoProducto = ""+$data->idTipoProducto;
  $producto->nombreProducto = $data->nombreProducto;
  $producto->imagenProducto = $data->imagenProducto;

  // Buscar Usuario
  $result = $producto->agregarProducto();

  echo json_encode($result);
?>
