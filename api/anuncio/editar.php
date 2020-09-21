<?php
    //CABEZERAS HEADERS
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Anuncio.php';

    // INICIAR INSTANCIA DE DB Y CONEXION
    $database = new Database();
    $db = $database->connect();

    // INICIAR ANUNCIO
    $anuncio = new Anuncio($db);

    // OBTENER FILA DE DATOS
    $data = json_decode(file_get_contents("php://input"));

    $anuncio->idAnuncio = $data->idAnuncio;
    /* $anuncio->tipoUsuario = $data->tipoUsuario; */
    /* $anuncio->codUsuario = $data->codUsuario; */
    $anuncio->idCategoria = $data->idCategoria;
    $anuncio->idSubCategoria = $data->idSubCategoria;
    /* $anuncio->fechaPublicacion = $data->fechaPublicacion; */
    $anuncio->tituloAnuncio = $data->tituloAnuncio;
    $anuncio->contenidoAnuncio = $data->contenidoAnuncio;
    $anuncio->precioAnuncio = $data->precioAnuncio;    
    /* $anuncio->idDepartamento = $data->idDepartamento;
    $anuncio->idProvincia = $data->idProvincia;
    $anuncio->idDistrito = $data->idDistrito; */

    // EDITAR ANUNCIO
    $result = $anuncio->editarAnuncio();

    // VERIFICAR ACCION EN LA DB
    $num = $result->rowCount();
    if($result){
        echo json_encode(array('success'=>'Editado'));
    }else{
        echo json_encode(array('error'=>'Sin respuesta'));
    }    
?>