<?php
    //CABEZERAS HEADERS
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../../config/Database.php';
    include_once '../../../models/Courier.php';

    // INICIAR INSTANCIA DE DB Y CONEXION
    $database = new Database();
    $db = $database->connect();

    // INICIAR DELIVERY
    $courier = new Courier($db);

    // OBTENER FILA DE DATOS
    $data = json_decode(file_get_contents("php://input"));
    
    $courier->idCourier = $data->idCourier;

    // AGREGAR COMENTARIO
    $result = $courier-> listarCourierEstado();

    // VERIFICAR ACCION EN LA DB   

    $num = $result->rowCount();
    if($result){
      $courier_arr = array();
      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        array_push($courier_arr,$row);
      }
      echo json_encode($courier_arr);
    }
    else { echo json_encode(array('error'=>'Sin respuesta')); }
?>