<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/ProductoTienda.php';

  $database = new Database();
  $db = $database->connect();

  $productoTienda = new ProductoTienda($db);

  $data = json_decode(file_get_contents("php://input"));
  
  $productoTienda->idTienda = ""+$data->idTienda;
  $productoTienda->idProducto = ""+$data->idProducto;

  $result = $productoTienda->retirarProductoTienda();

  echo json_encode($result);
?>
