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
  
  $tienda->idTienda = ""+$data->idTienda;
  $tienda->descripcionTienda = $data->descripcionTienda;
  $tienda->telefonoTienda = $data->telefonoTienda;
  $tienda->paginaWeb = $data->paginaWeb;
  $tienda->enlaceFacebook = $data->enlaceFacebook;
  $tienda->enlaceInstagram = $data->enlaceInstagram;
  $tienda->enlaceTwitter = $data->enlaceTwitter;
  $tienda->direccionTienda = $data->direccionTienda;
  $tienda->lat = $data->lat;
  $tienda->lng = $data->lng;
   
  // EDITAR TIENDA
  $result = $tienda->editarTienda();

  if($result){
    echo json_encode($tienda);
  }else {echo json_encode(array('error'=>'Sin respuesta')); }
?>
