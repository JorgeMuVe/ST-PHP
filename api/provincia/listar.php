<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Provincia.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Producto
  $provincia = new Provincia($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $provincia->idDepartamento = ""+$data->idDepartamento;
  
  // Bucar detalles Pedido
  $result = $provincia->listarProvincias();

  // Get row count
  $num = $result->rowCount();
  if($num > 0){
    $provincias = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        array_push($provincias,$row);
    }
    echo json_encode($provincias);
  }
  else { echo json_encode(array('error'=>'Sin respuesta')); }
?>