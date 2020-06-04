<?php

    $file = $_FILES['imagen'];
    $temp = $file['tmp_name'];
    $nombre = $file['name'];
  
    $path = '../../../../img/productos/'.$nombre;

    $image = file_get_contents($temp);
    $image = imagecreatefromstring($image);
  
    if($image){
      imagejpeg($image,$path);
      imagedestroy($image);
      echo json_encode(array('ruta'=>'/img/productos/'.$nombre));
    } else { echo json_encode(array('error'=>'Upload Failed')); }
?>