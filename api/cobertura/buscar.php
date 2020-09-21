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
  
  $cobertura->lat = ""+$data->lat;
  $cobertura->lng = ""+$data->lng;

  // Buscar Cobertura
  $result = $cobertura->buscarCoberturaDelivery();
  
  $num = $result->rowCount();
  if($num > 0){
    $coberturasExternas = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        array_push($coberturasExternas,$row);
    }
    echo json_encode($coberturasExternas);
  }
  else { echo json_encode(array('error'=>'No existen Deliverys Externos!.')); }
?>
