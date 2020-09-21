<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    $ultimo = $_POST['ultimo'];
    $carpeta = $_POST['carpeta'];
    $file = $_FILES['imagen'];
    $temp = $file['tmp_name'];
    $nombre = $file['name'];
    
    $pathEliminar = '../../..'.$ultimo;
    $pathAgregar = '../../../img/'.$carpeta.'/'.$nombre;
    
    $image = file_get_contents($temp);
    $image = imagecreatefromstring($image); 
    if($image){
      
      imagealphablending($image,false);
      imagesavealpha($image,true);
      imagecolortransparent($image);

      if(imagepng($image,$pathAgregar)){
        imagedestroy($image);
        $vacio = strpos($pathEliminar,'vacio');
        if($vacio === false){unlink($pathEliminar);}
        echo json_encode(array('ruta'=>'/img/'.$carpeta.'/'.$nombre));
      } else { echo json_encode(array('error'=>'Error al guardar el Archivo make.')); }
    } else { echo json_encode(array('error'=>'Error al guardar el Archivo save.')); }
?>