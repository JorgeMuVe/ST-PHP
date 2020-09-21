<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/ProductoTienda.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Producto
  $productoTienda = new ProductoTienda($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $productoTienda->idNegocio = ""+$data->idNegocio;
  $productoTienda->idProducto = ""+$data->idProducto;

  // Buscar Usuario
  $result = $productoTienda->listarTiendasProducto();

  //Get row count
  $numBusqueda = $result->rowCount();
  if($numBusqueda > 0){
    $listaProductos = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      array_push($listaProductos,$row);
    }
    echo json_encode($listaProductos);
  } else { echo json_encode(array('error'=>'Sin registros!.')); }
?>