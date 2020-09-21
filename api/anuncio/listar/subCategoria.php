<?php
    //CABEZERAS HEADERS
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../../config/Database.php';
    include_once '../../../models/Anuncio.php';

    // INICIAR INSTANCIA DE DB Y CONEXION
    $database = new Database();
    $db = $database->connect();

    // INICIAR DELIVERY
    $anuncio = new Anuncio($db);

    // OBTENER FILA DE DATOS
    $data = json_decode(file_get_contents("php://input"));

    $anuncio->idCategoria = $data->idCategoria;

    /* LISTAR CATEGORIA DE ANUNCIOS */
    $result = $anuncio->listarSubCategoria();

    // VERIFICAR ACCION EN LA DB
    $num = $result->rowCount();
    if($result){
      $anuncio_arr = array();
      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        array_push($anuncio_arr,$row);
      }
      echo json_encode($anuncio_arr);
    }
    else { echo json_encode(array('error'=>'Sin respuesta')); }
?>