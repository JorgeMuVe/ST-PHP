<?php 
  // Headers  
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../../config/Database.php';
  include_once '../../../models/Negocio.php';


  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Negocio
  $negocio = new Negocio($db);

  $data = json_decode(file_get_contents("php://input"));
  
  $negocio->idTipoNegocio = $data->idTipoNegocio;

  // Buscar Usuario
  $result = $negocio->listarNegociosPorTipo();
  
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
?>