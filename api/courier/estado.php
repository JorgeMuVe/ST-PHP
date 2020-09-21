<?php
    //CABEZERAS HEADERS
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Courier.php';

    // INICIAR INSTANCIA DE DB Y CONEXION
    $database = new Database();
    $db = $database->connect();

    // INICIAR DELIVERY
    $courier = new Courier($db);

    // OBTENER FILA DE DATOS
    $data = json_decode(file_get_contents("php://input"));

    $courier->idCourier = ""+$data->idCourier;
    $courier->estadoCourier = $data->estadoCourier;

    // AGREGAR COMENTARIO
    $result = $courier->actualizarEstadoCourier();
    
    if($result){
      echo json_encode(array('exito' => 'Exito cambiando estado'));
    }
    else { echo json_encode(array('error'=>'Sin respuesta')); }
?>