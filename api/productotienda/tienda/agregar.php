<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../../config/Database.php';
  include_once '../../../models/ProductoTienda.php';

  $database = new Database();
  $db = $database->connect();

  $productoTienda = new ProductoTienda($db);

  $data = json_decode(file_get_contents("php://input"));
  
  $productoTienda->idNegocio = ""+$data->idNegocio;
  $productoTienda->idTienda = ""+$data->idTienda;
  $productoTienda->idTipoProducto = ""+$data->idTipoProducto;
  $productoTienda->imagenProducto = $data->imagenProducto;
  $productoTienda->nombreProducto = $data->nombreProducto;
  $productoTienda->detalleProducto = $data->detalleProducto;
  $productoTienda->precioPorUnidad = ""+$data->precioPorUnidad;
  $productoTienda->unidadCantidad = ""+$data->unidadCantidad;
  $productoTienda->tipoUnidad = $data->tipoUnidad;
  $productoTienda->descuentoUnidad = ""+$data->descuentoUnidad;
  $productoTienda->stockDisponible = ""+$data->stockDisponible;
  $productoTienda->stockMinimo = ""+$data->stockMinimo;

  $result = $productoTienda->agregarProductoEnTienda();

  echo json_encode($result);
?>
