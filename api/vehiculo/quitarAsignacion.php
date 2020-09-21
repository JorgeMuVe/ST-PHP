<?php
    //CABEZERAS HEADERS
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Vehiculo.php';

    // INICIAR INSTANCIA DE DB Y CONEXION
    $database = new Database();
    $db = $database->connect();

    // INICIAR DELIVERY
    $vehiculo = new Vehiculo($db);

    // OBTENER FILA DE DATOS
    $data = json_decode(file_get_contents("php://input"));
    
    $vehiculo->idVehiculo = $data->idVehiculo;
    $vehiculo->idCourier = $data->idCourier;
    
    // AGREGAR COMENTARIO
    $result = $vehiculo->quitarAsignacionVehiculo();

    // VERIFICAR ACCION EN LA DB

    $num = $result->rowCount();
    if($num > 0){
      echo json_encode(array('exito' => 'Vehiculo desasignado'));
    }
    else { echo json_encode(array('error'=>'Sin respuesta')); }
?>