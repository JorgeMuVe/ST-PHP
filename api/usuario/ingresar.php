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

  $usuario->nombreUsuario = $data->nombreUsuario;
  $usuario->contrasena = $data->contrasena;

  // Ingresar Sistema
  $result = $usuario->ingresarSistema();

  // Get row count
  $num = $result->rowCount();

  // Check if any Usuarios
  if($num > 0){
    try {
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            echo json_encode($row);
        }
    }catch (PDOException $e) {
        echo json_encode(array('error'=>$e->getMessage()));  
    }
  }
  else { echo json_encode(array('error'=>'Resultado Vacio')); }
?>
