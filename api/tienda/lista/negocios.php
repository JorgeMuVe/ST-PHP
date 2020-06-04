<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../../config/Database.php';
  include_once '../../../models/Tienda.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Tienda
  $tienda = new Tienda($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $tienda->tipoNegocio = $data->tipoNegocio;
  $tienda->inicio = ""+$data->inicio;
  $tienda->cantidad = ""+$data->cantidad;  

  // Buscar Usuario
  $result = $tienda->listarNegociosTipo();

  //Get row count
  $numCantidad = $result[0]->rowCount();
  if($numCantidad > 0){
    $cantidadNegocios = $result[0]->fetch(PDO::FETCH_ASSOC);
    $numBusqueda = $result[1]->rowCount();
    if($numBusqueda > 0){
      $listaNegocios = array();
      while($row = $result[1]->fetch(PDO::FETCH_ASSOC)){
      extract($row);
        array_push($listaNegocios,$row);
      }
      echo json_encode( array(
        'cantidadNegocios'=>$cantidadNegocios["cantidadNegocios"],
        'listaNegocios'=>$listaNegocios
      ));
    } else { echo json_encode(array('error'=>'Sin registro de NegociosC!.')); }
  } else { echo json_encode(array('error'=>'Sin registro de NegociosB!.')); }
?>
