<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  $data = json_decode(file_get_contents("php://input"));

  $file = $_FILES['imagen'];
  $last = $_POST['ultimo'];
      
  $res = array();
    
  array_push($res,$file);
  array_push($res,$last);
    
  echo json_encode($res);


  /*
      //$file = $_FILES['imagen'];
    //$las = $_POST['lasName'];
    
    //$temp = $file['tmp_name'];
    //$nombre = $file['name'];
    
    
    $path = '../../../../img/clientes/'.$nombre;

    $image = file_get_contents($temp);
    $image = imagecreatefromstring($image);
  
    if($image){
      unlink($path);
      imagejpeg($image,$path);
      imagedestroy($image);
      echo json_encode(array('ruta'=>'/img/clientes/'.$nombre));
    } else { echo json_encode(array('error'=>'Upload Failed')); }
  */
?>