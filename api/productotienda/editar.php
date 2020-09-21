<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/ProductoTienda.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Producto
  $productoTienda = new ProductoTienda($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));
  
  $productoTienda->idProducto = ""+$data->idProducto;
  $productoTienda->idProductoTienda = ""+$data->idProductoTienda;
  $productoTienda->idTipoProducto = ""+$data->idTipoProducto;
  $productoTienda->nombreProducto = $data->nombreProducto;
  $productoTienda->imagenProducto = $data->imagenProducto;
  $productoTienda->detalleProducto = $data->detalleProducto;
  $productoTienda->precioPorUnidad = ""+$data->precioPorUnidad;
  $productoTienda->unidadCantidad = ""+$data->unidadCantidad;
  $productoTienda->tipoUnidad = $data->tipoUnidad;
  $productoTienda->descuentoUnidad = ""+$data->descuentoUnidad;
  $productoTienda->stockDisponible = ""+$data->stockDisponible;
  $productoTienda->stockMinimo = ""+$data->stockMinimo;

  // Buscar Usuario
  $result = $productoTienda->editarProductoTienda();

  echo json_encode($result);
?>
