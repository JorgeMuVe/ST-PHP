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
  $negocio->idTipoNegocio = ""+$data->idTipoNegocio;
  $negocio->nombreNegocio = $data->nombreNegocio;
  $negocio->ruc = $data->ruc;
  $negocio->logo = $data->logo;
  $negocio->correoNegocio = $data->correoNegocio;
  $negocio->telefonoNegocio = $data->telefonoNegocio;
  $negocio->descripcionNegocio = $data->descripcionNegocio;

  // EDITAR TIENDA
  $result = $negocio->editarNegocio();

    // Get row count
  $num = $result->rowCount();
  if($num > 0){
    $tipos_arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        array_push($tipos_arr,$row);
    }
    echo json_encode($tipos_arr);
  }
  else { echo json_encode(array('error'=>'Sin respuesta')); }
  /*

  if($result){
    echo json_encode($result);
  }else {echo json_encode(array('error'=>'Sin respuesta')); }
  */
?>
