<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Departamento.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Producto
  $departamento = new Departamento($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));
  
  // Bucar detalles Pedido
  $result = $departamento->listarDepartamentos();

  // Get row count
  $num = $result->rowCount();
  if($num > 0){
    $departamentos = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        array_push($departamentos,$row);
    }
    echo json_encode($departamentos);
  }
  else { echo json_encode(array('error'=>'Sin respuesta')); }
?>