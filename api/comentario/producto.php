<?php
     //CABEZERAS HEADERS
     header('Access-Control-Allow-Origin: *');
     header('Content-Type: application/json');
     header('Access-Control-Allow-Methods: POST');
     header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

     include_once '../../config/Database.php';     
     include_once '../../models/Comentario.php';
 
     // INICIAR INSTANCIA DE DB Y CONEXION
     $database = new Database();
     $db = $database->connect();

     // INICIAR COMENTARIO
     $comentario = new Comentario($db);
 
     // OBTENER FILA DE DATOS
     $data = json_decode(file_get_contents("php://input"));
 
     $comentario->idTipoComentario = $data->idTipoComentario;
 
     // LISTAR COMENTARIO
     $result = $comentario->listarComentarioProducto();
     // VERIFICAR ACCION EN LA DB
     $num = $result->rowCount();
     if($num > 0){
         $comentarios = array();
         while($row = $result->fetch(PDO::FETCH_ASSOC)){
             extract($row);
             array_push($comentarios, $row);                             
         }
         echo json_encode($comentarios);
         
     }
     else { echo json_encode(array('error'=>'Sin respuesta')); }
?>