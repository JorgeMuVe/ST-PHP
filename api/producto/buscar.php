<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Producto.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Producto
  $producto = new Producto($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));
  $producto->idDepartamento = ""+$data->idDepartamento;
  $producto->idProvincia = ""+$data->idProvincia;
  $producto->idDistrito = ""+$data->idDistrito;
  $producto->tipo = $data->tipo;
  $producto->texto = "%".(($data->texto)?$data->texto:"%")."%";
  $producto->id = ""+$data->id;
  $producto->inicio = ""+$data->inicio;
  $producto->cantidad = ""+$data->cantidad;

  // Buscar Producto
  $result = $producto->buscarProducto();
  $numCantidad = $result->rowCount();
  if($numCantidad > 0){
    try{
      $listaProductos = array();
      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        array_push($listaProductos,$row);
      }
      echo json_encode($listaProductos);
    } catch (PDOException $e) { echo json_encode(array('error'=>$e->getMessage())); }
  } else { echo json_encode(array('error'=>'No se encontro productos!.')); }
?>
