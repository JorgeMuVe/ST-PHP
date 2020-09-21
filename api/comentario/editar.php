<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Comentario.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Producto
$comentario = new Comentario($db);

// Get raw data
$data = json_decode(file_get_contents("php://input"));

$comentario->n_texto = $data->n_texto;
$comentario->idUsuario = $data->idUsuario;
$comentario->n_fecha = $data->n_fecha;
$comentario->idComentario = $data->idComentario;

// Buscar Comentario
$result = $comentario->editarComentario();

// Get row count
$num = $result->rowCount();
   if($result){
        echo json_encode(array('success'=>'Editado exitoso'));
    }else{
        echo json_encode(array('error'=>'Sin respuesta'));
    } 
?>