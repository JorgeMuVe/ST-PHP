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

  // Instantiate Cliente
  $cliente = new Cliente($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));
  
  $cliente->idCliente = ""+$data->idCliente;
  $cliente->registroNacional = $data->registroNacional;
  $cliente->nombreCompleto = $data->nombreCompleto;
  $cliente->apellidoPaterno = $data->apellidoPaterno;
  $cliente->apellidoMaterno = $data->apellidoMaterno;
  $cliente->telefonoCliente = $data->telefonoCliente;
  $cliente->imagenCliente = $data->imagenCliente;

  // EDITAR Cliente
  $result = $cliente->editarCliente();
  if($result){
    echo json_encode($result);
  }else {echo json_encode(array('error'=>'No se Editó!')); }
?>
