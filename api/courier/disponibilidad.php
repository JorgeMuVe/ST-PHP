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

    // INICIAR COURIER
    $courier = new Courier($db);

    // OBTENER FILA DE DATOS
    $data = json_decode(file_get_contents("php://input"));

    $courier->idCourier = $data->idCourier;
    $courier->dispCourier = $data->dispCourier;

    // ACTUALIZAR DISPONIBILIDAD
    $result = $courier->actualizarDispCourier();

    // VERIFICAR ACCION EN LA DB   

    $num = $result->rowCount();
    if($num > 0){
      echo json_encode(array('exito' => 'Exito cambiando disponibilidad'));
    }
    else { echo json_encode(array('error'=>'Sin respuesta')); }
?>