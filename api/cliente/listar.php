<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Cliente.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Clientes
  $cliente = new Cliente($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $cliente->inicio = ""+$data->inicio;
  $cliente->cantidad = ""+$data->cantidad;

  // Buscar Pedidos
  $result = $cliente->listarClientes();

  //Get row count
  $numCantidad = $result[0]->rowCount();
  if($numCantidad > 0){
    $cantidadClientes = $result[0]->fetch(PDO::FETCH_ASSOC);
    $numBusqueda = $result[1]->rowCount();
    if($numBusqueda > 0){
      $listaClientes = array();
      try {
        while($row = $result[1]->fetch(PDO::FETCH_ASSOC)){
          extract($row);
          array_push($listaClientes,$row);
        }
        echo json_encode( array(
          'cantidadClientes'=>$cantidadClientes["cantidadClientes"],
          'listaClientes'=>$listaClientes
        ));
      } catch (PDOException $e) {
        echo json_encode(array('error'=>$e->getMessage()));  
      }    
    } else { echo json_encode(array('error'=>'Sin registro de Clientes ERR0!.')); }
  } else { echo json_encode(array('error'=>'Sin registro de Clientes ERR1!.')); }
?>
