<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Cliente.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate cliente
  $cliente = new Cliente($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));
  
  $cliente->idCliente = ""+$data->idCliente;
  $cliente->imagenCliente = $data->imagenCliente;
  $cliente->marcador = $data->marcador;

  // EDITAR cliente
  $result = $cliente->cambiarImagenCliente();
  
  if($result){
    echo json_encode($result);
  }else {echo json_encode(array('error'=>'Sin respuesta'));}
  
?>
