<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Tienda.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Tienda
  $tienda = new Tienda($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $tienda->idNegocio = ""+$data->idNegocio;
  $tienda->idTipoNegocio = ""+$data->idTipoNegocio;
  $tienda->numeroTienda = $data->numeroTienda;
  $tienda->nombreTienda = $data->nombreTienda;
  $tienda->ruc = $data->ruc;
  $tienda->logo = $data->logo;
  $tienda->correoTienda = $data->correoTienda;
  $tienda->telefonoTienda = $data->telefonoTienda;
  $tienda->direccionTienda = $data->direccionTienda;
  $tienda->descripcionTienda = $data->descripcionTienda;
  $tienda->lat = ""+$data->lat;
  $tienda->lng = ""+$data->lng;

  // Buscar Usuario
  $result = $tienda->agregarTienda();

  echo json_encode($result);
?>
