<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../../config/Database.php';
  include_once '../../../models/Producto.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Producto
  $producto = new Producto($db);

  $data = json_decode(file_get_contents("php://input"));

  $producto->idNegocio = ""+$data->idNegocio;
  $producto->inicio = ""+$data->inicio;
  $producto->cantidad = ""+$data->cantidad;

  // Listar Productos
  $result = $producto->listarProductosNegocio();

  //Get row count
  $numCantidad = $result[0]->rowCount();
  if($numCantidad > 0){
    $cantidadProductos = $result[0]->fetch(PDO::FETCH_ASSOC);
    $numBusqueda = $result[1]->rowCount();
    if($numBusqueda > 0){
      $listaProductos = array();
      while($row = $result[1]->fetch(PDO::FETCH_ASSOC)){
      extract($row);
        array_push($listaProductos,$row);
      }
      echo json_encode( array(
        'cantidadProductos'=>$cantidadProductos["cantidadProductos"],
        'listaProductos'=>$listaProductos
      ));
    } else { echo json_encode(array('error'=>'Sin registro de Productos a!.')); }
  } else { echo json_encode(array('error'=>'Sin registro de Productos b!.')); }
?>
