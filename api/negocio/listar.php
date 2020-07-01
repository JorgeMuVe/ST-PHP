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

  // Instantiate Negocio
  $Negocio = new Negocio($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $Negocio->inicio = ""+$data->inicio;
  $Negocio->cantidad = ""+$data->cantidad;

  // Listar Negocio
  $result = $Negocio->listarNegocios();

  //Get row count
  $numCantidad = $result[0]->rowCount();
  if($numCantidad > 0){
    $cantidadNegocios = $result[0]->fetch(PDO::FETCH_ASSOC);
    $numBusqueda = $result[1]->rowCount();
    if($numBusqueda > 0){
      $listaNegocios = array();
      try {
        while($row = $result[1]->fetch(PDO::FETCH_ASSOC)){
          extract($row);
          array_push($listaNegocios,$row);
        }
        echo json_encode( array(
          'cantidadNegocios'=>$cantidadNegocios["cantidadNegocios"],
          'listaNegocios'=>$listaNegocios
        ));
      } catch (PDOException $e) {
        echo json_encode(array('error'=>$e->getMessage()));  
      }    
    } else { echo json_encode(array('error'=>'Sin registro de Negocios ERR0!.')); }
  } else { echo json_encode(array('error'=>'Sin registro de Negocios ERR1!.')); }
?>