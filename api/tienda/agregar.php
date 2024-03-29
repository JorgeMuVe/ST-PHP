<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Tienda.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Tienda
  $tienda = new Tienda($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $tienda->idNegocio = ""+$data->idNegocio;
  $tienda->idTipoNegocio = ""+$data->idTipoNegocio;
  $tienda->nombreTienda = $data->nombreTienda;
  $tienda->ruc = $data->ruc;
  $tienda->logo = $data->logo;
  $tienda->portada = $data->portada;
  $tienda->correoTienda = $data->correoTienda;
  $tienda->telefonoTienda = $data->telefonoTienda;
  $tienda->descripcionTienda = $data->descripcionTienda;
  $tienda->direccionTienda = $data->direccionTienda;
  $tienda->idDepartamento = ""+$data->idDepartamento;
  $tienda->idProvincia = ""+$data->idProvincia;
  $tienda->idDistrito = ""+$data->idDistrito;
  $tienda->lat = ""+$data->lat;
  $tienda->lng = ""+$data->lng;
  $tienda->contrasena = $data->contrasena;

  // Buscar Usuario
  $result = $tienda->agregarTienda();

  //Get row count
  $num = $result->rowCount();
  if($num > 0){
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      echo json_encode($row);
    }
  } else { echo json_encode(array('error'=>'No se Agrego Tienda.')); }
?>
