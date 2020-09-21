<?php
    //CABEZERAS HEADERS
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Anuncio.php';

    // INICIAR INSTANCIA DE DB Y CONEXION
    $database = new Database();
    $db = $database->connect();

    // INICIAR ANUNCIO
    $anuncio = new Anuncio($db);

    // OBTENER FILA DE DATOS
    $data = json_decode(file_get_contents("php://input"));

    $anuncio->idAnuncio = $data->idAnuncio;    
    
    // ELIMINAR COMENTARIO
    $result = $anuncio->eliminarAnuncio();

    // VERIFICAR ACCION EN LA DB
    $num = $result->rowCount();
    if($result){
        echo json_encode(array('success'=>'Eliminado'));
    }else{
        echo json_encode(array('error'=>'Sin respuesta'));
    }    
?>