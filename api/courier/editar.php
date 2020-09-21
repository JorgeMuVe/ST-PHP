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
    $courier->registroNacional = $data->registroNacional;
    $courier->nombreCompleto = $data->nombreCompleto;
    $courier->apellidoPaterno = $data->apellidoPaterno;
    $courier->apellidoMaterno = $data->apellidoMaterno;    
    $courier->telefonoCourier = $data->telefonoCourier;    

    // AGREGAR COURIER
    $result = $courier->editarCourier();

    // VERIFICAR ACCION EN LA DB    
    if($result){
      echo json_encode(array('exito' => 'Courier Editado'));
    }
    else { echo json_encode(array('error'=>'Sin respuesta')); }
?>