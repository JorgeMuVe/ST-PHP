<?php
    //CABEZERAS HEADERS
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Pedido.php';

    // INICIAR INSTANCIA DE DB Y CONEXION
    $database = new Database();
    $db = $database->connect();

    // INICIAR DELIVERY
    $pedido = new Pedido($db);

    // OBTENER FILA DE DATOS
    $data = json_decode(file_get_contents("php://input"));

    $pedido->idPedido = $data->idPedido;
    $pedido->estadoPedido = $data->estadoPedido;

    // AGREGAR COMENTARIO
    $result = $pedido->actualizarEstadoPedido();

    // VERIFICAR ACCION EN LA DB   

    $num = $result->rowCount();
    if($num > 0){
      echo json_encode(array('exito' => 'Exito cambiando estado'));
    }
    else { echo json_encode(array('error'=>'Sin respuesta')); }
?>