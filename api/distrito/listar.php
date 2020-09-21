<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Distrito.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Producto
  $distrito = new Distrito($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $distrito->idProvincia = ""+$data->idProvincia;
  
  // Bucar detalles Pedido
  $result = $distrito->listarDistritos();

  // Get row count
  $num = $result->rowCount();
  if($num > 0){
    $distritos = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        array_push($distritos,$row);
    }
    echo json_encode($distritos);
  }
  else { echo json_encode(array('error'=>'Sin respuesta')); }
?>