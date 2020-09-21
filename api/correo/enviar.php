<?php
// Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  // Get raw data
  $data = json_decode(file_get_contents("php://input"));
  
  $nombres = $data->nombres;
  $apellidos = $data->apellidos;
  $email = $data->email;
  $telefono = $data->telefono;
  $mensaje = $data->mensaje;

  $correorecibido = "De: $nombres $apellidos \n";
  $correorecibido .= "Email: $email \n";
  $correorecibido .= "Telefono: $telefono \n";
  $correorecibido .= "Mensaje: $mensaje \n";

  $destinatario = "info@reactiva-peru.com";
  $asunto = "Contacto desde la web";

  if(mail($destinatario, $asunto, $correorecibido)){
    echo json_encode(array('enviado'=>'Correo enviado'));
  }else { echo json_encode(array('error'=>'No se Envio')); }
?>