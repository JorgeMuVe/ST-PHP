<?php
    //CABEZERAS HEADERS
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Puntuacion.php';

    // INICIAR INSTANCIA DE DB Y CONEXION
    $database = new Database();
    $db = $database->connect();

    // INICIAR PUNTUACION
    $puntuacion = new Puntuacion($db);

    // OBTENER FILA DE DATOS
    $data = json_decode(file_get_contents("php://input"));

    $puntuacion->tipoPuntuacion = $data->tipoPuntuacion;    
    $puntuacion->idTipoPuntuacion = $data->idTipoPuntuacion;    
    $puntuacion->nPuntuacion = $data->nPuntuacion;    
    $puntuacion->fechaPuntuacion = $data->fechaPuntuacion;
    $puntuacion->idUsuario = $data->idUsuario;

    // AGREGAR PUNTUACION
    $result = $puntuacion->agregarPuntuacion();

    // VERIFICAR ACCION EN LA DB
    $num = $result->rowCount();
    if($result){
        echo json_encode(array('success'=>'Puntuacion Agregada'));
    }else{
        echo json_encode(array('error'=>'Sin respuesta'));
    }    
?>