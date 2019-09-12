<?php
session_start();
require('./conector.php');
$con = new ConectorBD('localhost','root','');

$response ['msg'] = $con->initConexion('agenda_db');
if($response['msg'] == 'OK'){
  $condicion= 'id='.$_POST['id'];

  if($con->eliminarRegistro('eventos', $condicion)){
      $response['msg'] = 'OK';
  }else{
      /*Mostrar mensaje de error*/
      $response['msg'] = "No se ha podido eliminar el registro";

}
}else {
    $response['msg'] = "Error en la comunicacion con la base de datos";
}
echo json_encode($response);


 ?>
