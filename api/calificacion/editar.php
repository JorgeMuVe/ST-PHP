<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Calificacion.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Calificacion
  $calificacion = new Calificacion($db);

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));

  $calificacion->tipo = ""+$data->tipo;
  $calificacion->idCalificado = ""+$data->idCalificado;
  $calificacion->idPuntuacion = ""+$data->idPuntuacion;
  $calificacion->idComentario = ""+$data->idComentario;
  $calificacion->puntuacion = ""+$data->puntuacion;
  $calificacion->comentario = $data->comentario;

  $result = $calificacion->editarCalificacion();
  
  if($result){
    echo json_encode($calificacion);
  }
  else { echo json_encode(array('error'=>'No se pudo cambiar la calificación!.')); }
?>
