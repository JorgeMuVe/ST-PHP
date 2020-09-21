<?php 
  // Headers  
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../../config/Database.php';
  include_once '../../../models/Negocio.php';


  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Negocio
  $negocio = new Negocio($db);

  $data = json_decode(file_get_contents("php://input"));

  $negocio->idDepartamento = ""+$data->idDepartamento;
  $negocio->idProvincia = ""+$data->idProvincia;
  $negocio->idDistrito = ""+$data->idDistrito;
  $negocio->idTipoNegocio = $data->idTipoNegocio;
  $negocio->inicio = ""+ $data->inicio;
  $negocio->cantidad = ""+$data->cantidad;

  // Buscar Usuario
  $result = $negocio->listarNegociosPorTipo();
  
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
    } else { echo json_encode(array('error'=>'Sin registro Negocios!.')); }
  } else { echo json_encode(array('error'=>'Sin registro Cantidad Negocios!.')); }
?>