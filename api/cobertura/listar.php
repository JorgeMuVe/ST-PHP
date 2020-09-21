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
  
  $cobertura->idTienda = ""+$data->idTienda;
  $cobertura->inicio = ""+$data->inicio;
  $cobertura->cantidad = ""+$data->cantidad;

  // Buscar Cobertura
  $result = $cobertura->listarCoberturaTienda();

    // Get row count
  $num = $result->rowCount();
  if($num > 0){
    $coberturasTienda = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        array_push($coberturasTienda,$row);
    }
    echo json_encode($coberturasTienda);
  }
  else { echo json_encode(array('error'=>'La tienda no tiene coberturas registradas!.')); }

?>
