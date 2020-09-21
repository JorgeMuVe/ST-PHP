<?php
    //CABEZERAS HEADERS
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../../config/Database.php';
    include_once '../../../models/Vehiculo.php';

    // INICIAR INSTANCIA DE DB Y CONEXION
    $database = new Database();
    $db = $database->connect();

    // INICIAR VEHICULO
    $vehiculo = new Vehiculo($db);

    // OBTENER FILA DE DATOS
    $data = json_decode(file_get_contents("php://input"));

    $vehiculo->idEmpDelivery = $data->idEmpDelivery;
    $vehiculo->estadoVehiculo = $data->estadoVehiculo;

    // LISTAR VEHICULOS
    $result = $vehiculo->listarVehiculo();

    // VERIFICAR ACCION EN LA DB   

    $num = $result->rowCount();
    if($num > 0){
      $vehiculo_arr = array();
      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        array_push($vehiculo_arr,$row);
      }
      echo json_encode($vehiculo_arr);
    }
    else { echo json_encode(array('error'=>'Sin respuesta')); }
?>