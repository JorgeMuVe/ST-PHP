<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Direccion.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Producto
  $direccion = new Direccion($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $direccion->codigoUsuario = $data->codigoUsuario;
  $direccion->inicio = $data->inicio;
  $direccion->cantidad = $data->cantidad;

  // Buscar Usuario
  $result = $direccion->paginadoDirecciones();

  //Get row count
  $numCantidad = $result[0]->rowCount();
  if($numCantidad > 0){
    $cantidadDirecciones = $result[0]->fetch(PDO::FETCH_ASSOC);
    $numBusqueda = $result[1]->rowCount();
    if($numBusqueda > 0){
      $listaDirecciones = array();
      while($row = $result[1]->fetch(PDO::FETCH_ASSOC)){
      extract($row);
        array_push($listaDirecciones,$row);
      }
      echo json_encode( array(
        'cantidadDirecciones'=>$cantidadDirecciones["cantidadDirecciones"],
        'listaDirecciones'=>$listaDirecciones
      ));
    } else { echo json_encode(array('error'=>'Sin registro de Direcciones!.')); }
  } else { echo json_encode(array('error'=>'Sin registro de Direcciones!.')); }
?>
