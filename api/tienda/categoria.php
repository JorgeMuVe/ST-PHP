<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Categoria.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate categoria
  $categoria = new Categoria($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $categoria->idNegocio = ""+$data->idNegocio;
  $categoria->idTipoNegocio = ""+$data->idTipoNegocio;
  $categoria->inicio = ""+$data->inicio;
  $categoria->cantidad = ""+$data->cantidad;  

  // Buscar Usuario
  $result = $categoria->listarTiendasPorTipoNegocio();

  //Get row count
  $numCantidad = $result[0]->rowCount();
  if($numCantidad > 0){
    $cantidadTiendas = $result[0]->fetch(PDO::FETCH_ASSOC);
    $numBusqueda = $result[1]->rowCount();
    if($numBusqueda > 0){
      $listaTiendas = array();
      while($row = $result[1]->fetch(PDO::FETCH_ASSOC)){
      extract($row);
        array_push($listaTiendas,$row);
      }
      echo json_encode( array(
        'cantidadTiendas'=>$cantidadTiendas["cantidadTiendas"],
        'listaTiendas'=>$listaTiendas
      ));
    } else { echo json_encode(array('error'=>'Sin registro Tiendas!.')); }
  } else { echo json_encode(array('error'=>'Sin registro Cantidad Tiendas!.')); }
?>