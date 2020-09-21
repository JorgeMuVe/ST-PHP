<?php
    //CABEZERAS HEADERS
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../../config/Database.php';
    include_once '../../../models/Delivery.php';

    // INICIAR INSTANCIA DE DB Y CONEXION
    $database = new Database();
    $db = $database->connect();

    // INICIAR DELIVERY
    $delivery = new Delivery($db);

    // OBTENER FILA DE DATOS
    $data = json_decode(file_get_contents("php://input"));
    
    // AGREGAR COMENTARIO
    $result = $delivery->listarSDelivery();

    // VERIFICAR ACCION EN LA DB   

    $num = $result->rowCount();
    if($num > 0){
      $delivery_arr = array();
      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        array_push($delivery_arr,$row);
      }
      echo json_encode($delivery_arr);
    }
    else { echo json_encode(array('error'=>'Sin respuesta')); }
?>