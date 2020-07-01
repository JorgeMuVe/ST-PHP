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
  
  $usuario->idUsuario = $data->idUsuario;
  $usuario->contrasena = $data->contrasena;

  // Agregar Usuario
  $result = $usuario->cambiarContrasena();

  if($result){ echo json_encode($usuario); }
  else { echo json_encode(array('error'=>'Error al Cambiar Contraseña')); }