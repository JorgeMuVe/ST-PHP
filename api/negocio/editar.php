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

  // Instantiate NEGOCIO
  $negocio = new Negocio($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));
  
  $negocio->idNegocio = ""+$data->idNegocio;
  $negocio->descripcionNegocio = $data->descripcionNegocio;
  $negocio->telefonoNegocio = $data->telefonoNegocio;
  $negocio->paginaWeb = $data->paginaWeb;
  $negocio->enlaceFacebook = $data->enlaceFacebook;
  $negocio->enlaceInstagram = $data->enlaceInstagram;
  $negocio->enlaceTwitter = $data->enlaceTwitter;
  $negocio->direccionNegocio = $data->direccionNegocio;
  $negocio->lat = $data->lat;
  $negocio->lng = $data->lng;

  // EDITAR NEGOCIO
  $result = $negocio->editarNegocio();
  
  if($result){
    echo json_encode($result);
  }else {echo json_encode(array('error'=>'Sin respuesta')); }
?>
