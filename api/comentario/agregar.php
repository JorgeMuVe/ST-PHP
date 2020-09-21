<?php
    //CABEZERAS HEADERS?
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Comentario.php';

    // INICIAR INSTANCIA DE DB Y CONEXION
    $database = new Database();
    $db = $database->connect();

    // INICIAR COMENTARIO
    $comentario = new Comentario($db);

    // OBTENER FILA DE DATOS
    $data = json_decode(file_get_contents("php://input"));

    $comentario->tipoComentario = $data->tipoComentario;    
    $comentario->idTipoComentario = $data->idTipoComentario;    
    $comentario->textoComentario = $data->textoComentario;    
    $comentario->fechaComentario = $data->fechaComentario;
    $comentario->idUsuario = $data->idUsuario;

    // AGREGAR COMENTARIO
    $result = $comentario->agregarComentario();
    if($result){
        echo json_encode(array('success'=>'Agregado'));
    }else{
        echo json_encode(array('error'=>'Sin respuesta'));
    }
?>