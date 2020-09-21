<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    $ultimo = $_POST['ultimo'];
    $carpeta = $_POST['carpeta'];    
    
    $pathEliminar = '../../..'.$ultimo;    
    
    if($ultimo){      
        $vacio = strpos($pathEliminar,'vacio');
        if($vacio === false){unlink($pathEliminar);}
        echo json_encode(array('ruta'=> $ultimo));
    } else { echo json_encode(array('error'=>'Error al eliminar Multimedia Anuncio.')); }      
?>