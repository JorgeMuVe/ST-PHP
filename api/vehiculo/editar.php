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

    // INICIAR COURIER
    $vehiculo = new Vehiculo($db);

    // OBTENER FILA DE DATOS
    $data = json_decode(file_get_contents("php://input"));

    $vehiculo->idVehiculo = $data->idVehiculo;
    $vehiculo->placaVehiculo = $data->placaVehiculo;    

    // AGREGAR COURIER
    $result = $vehiculo->editarVehiculo();

    // VERIFICAR ACCION EN LA DB    
    if($result){
      echo json_encode(array('exito' => 'Vehiculo Editado'));
    }
    else { echo json_encode(array('error'=>'Sin respuesta')); }
?>