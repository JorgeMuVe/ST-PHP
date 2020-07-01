<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Usuario.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Usuario
  $usuario = new Usuario($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $usuario->inicio = ""+$data->inicio;
  $usuario->cantidad = ""+$data->cantidad;

  // Buscar Pedidos
  $result = $usuario->listarUsuarios();

  //echo json_encode($result);

  //Get row count
  $numCantidad = $result[0]->rowCount();
  if($numCantidad > 0){
    $cantidadUsuarios = $result[0]->fetch(PDO::FETCH_ASSOC);
    $numBusqueda = $result[1]->rowCount();
    if($numBusqueda > 0){
      $listaUsuarios = array();
      try {
        while($row = $result[1]->fetch(PDO::FETCH_ASSOC)){
          extract($row);
          array_push($listaUsuarios,$row);
        }
        echo json_encode( array(
          'cantidadUsuarios'=>$cantidadUsuarios["cantidadUsuarios"],
          'listaUsuarios'=>$listaUsuarios
        ));
      } catch (PDOException $e) {
        echo json_encode(array('error'=>$e->getMessage()));  
      }    
    } else { echo json_encode(array('error'=>'Sin registro de Usuarios ERR0!.')); }
  } else { echo json_encode(array('error'=>'Sin registro de Usuarios ERR1!.')); }
  
?>