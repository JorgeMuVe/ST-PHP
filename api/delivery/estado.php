<?php
    //CABEZERAS HEADERS
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Delivery.php';

    // INICIAR INSTANCIA DE DB Y CONEXION
    $database = new Database();
    $db = $database->connect();

    // INICIAR DELIVERY
    $delivery = new Delivery($db);

    // OBTENER FILA DE DATOS
    $data = json_decode(file_get_contents("php://input"));

    $delivery->idDelivery = $data->idDelivery;
    $delivery->estadoDelivery = $data->estadoDelivery;

    // AGREGAR COMENTARIO
    $result = $delivery->actualizarEstadoDelivery();

    // VERIFICAR ACCION EN LA DB   

    $num = $result->rowCount();
    if($num > 0){
      echo json_encode(array('exito' => 'Exito cambiando estado'));
    }
    else { echo json_encode(array('error'=>'Sin respuesta')); }
?>