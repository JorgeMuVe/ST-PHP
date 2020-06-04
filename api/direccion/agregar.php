<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Direccion.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Producto
  $direccion = new Direccion($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $direccion->idCliente = ""+$data->idCliente;
  $direccion->denominacionDireccion = $data->denominacionDireccion;
  $direccion->referenciaDireccion = $data->referenciaDireccion;
  $direccion->lat = $data->lat;
  $direccion->lng = $data->lng;

  // Buscar Usuario
  $result = $direccion->agregarDireccion();

  echo json_encode($result);
?>
