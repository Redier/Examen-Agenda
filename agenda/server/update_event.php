<?php
session_start();
require('./conector.php');
$con = new ConectorBD('localhost','root','');

$response ["msg"] = $con->initConexion('agenda_db');


  if($response['msg'] == 'OK'){
        $data['id'] = '"'.$_POST['id'].'"';
        $data['fecha_ini'] = '"'.$_POST['start_date'].'"';
        $data['hora_ini'] = '"'.$_POST['start_hour'].'"';
        $data['fecha_fin'] = '"'.$_POST['end_date'].'"';
        $data['hora_fin'] = '"'.$_POST['end_hour'].'"';

        if($data['id'] != 'undefined'){
          $resultado = $con->actualizarRegistro('eventos', $data, 'id ='.$data['id']); //Actualizar el registro que coincida con el id del evento a actualizar
          $response['msg'] = 'OK';
        }else{
          $response['msg'] = "Ha ocurrido un error al actualizar el evento";
        }
  }else{
      /*Mostrar mensaje de error*/
      $response['msg'] = "Error en la comunicacion con la base de datos";
  }
  /*devolver el arreglo response en formato json*/
  echo json_encode($response);

$con->cerrarConexion()


 ?>
