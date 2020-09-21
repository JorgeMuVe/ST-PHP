<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Cobertura.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Cobertura
  $cobertura = new Cobertura($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));
  
  $cobertura->idCobertura = ""+$data->idCobertura;

  // Buscar Cobertura
  $result = $cobertura->obtenerCoberturaId();
  
  $num = $result->rowCount();
  if($num > 0){
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      echo json_encode($row);
    }
  }
  else { echo json_encode(array('error'=>'No existe Tarifa o Cobertura')); }
?>
