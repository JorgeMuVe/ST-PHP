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
  
  $usuario->tipoUsuario = $data->tipoUsuario;
  $usuario->correoCuenta = $data->correoCuenta;
  $usuario->contrasenaActual = $data->contrasenaActual;
  $usuario->contrasenaNueva = $data->contrasenaNueva;

  // Agregar Usuario
  $result = $usuario->cambiarContrasena();
  $num = $result->rowCount();
  if($num > 0){
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);
      echo json_encode($row);
    }
  } else { echo json_encode(array('error'=>'Error al Cambiar Contraseña')); }