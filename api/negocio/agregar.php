<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Negocio.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Tienda
  $negocio = new Negocio($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));
  
  $negocio->nombreNegocio = $data->nombreNegocio;
  $negocio->ruc = $data->ruc;
  $negocio->logo = $data->logo;
  $negocio->correoNegocio = $data->correoNegocio;
  $negocio->telefonoNegocio = $data->telefonoNegocio;
  $negocio->descripcionNegocio = $data->descripcionNegocio;

  // Buscar Usuario
  $result = $negocio->agregarTienda();

  echo json_encode($result);
?>
