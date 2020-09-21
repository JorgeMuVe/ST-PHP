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
  
  $negocio->idNegocio = ""+$data->idNegocio;
  $negocio->portada = $data->portada;

  // EDITAR TIENDA
  $result = $negocio->cambiarPortadaNegocio();
  
  if($result){
    echo json_encode($result);
  }else {echo json_encode(array('error'=>'Sin respuesta'));}
  
?>