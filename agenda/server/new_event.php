<?php
    session_start();
    require('./conector.php');
    $con = new ConectorBD('localhost','root','');

    $response ['msg'] = $con->initConexion('agenda_db');
    if($response['msg'] == 'OK'){
      /*Generar un arreglo con la información a enviar*/
      $data['titulo']= "'".$_POST['titulo']."'";
      $data['fecha_ini']='"'.$_POST['start_date'].'"';
      $data['hora_ini'] = '"'.$_POST['start_hour'].':00"';/*Add ":00" to fill datetime format*/
      $data['fecha_fin'] = '"'.$_POST['end_date'].'"';
      $data['hora_fin'] = '"'.$_POST['end_hour'].':00"'; /*Add ":00" to fill datetime format*/
      $data['dia_completo'] = $_POST['allDay'];
      $data['fk_usuario'] = '"'.$_SESSION['username'].'"';

      if($con->insertData('eventos', $data)){
          /*Mostrar mensaje success*/
          $resultado = $con->consultar(['eventos'],['MAX(id)']); //Obtener el id registrado perteneciente al nuevo registro
          while($fila = $resultado->fetch_assoc()){
            $response['id']=$fila['MAX(id)']; //Enviar ultimo Id guardado como parámetro para el calendario
          }
          $response['msg'] = 'OK';
      }else{
          /*Mostrar mensaje de error*/
          $response['msg'] = "Ha ocurrido un error al guardar el evento";

    }
    }else {
        $response['msg'] = "Error en la comunicacion con la base de datos";
    }
    echo json_encode($response);

 ?>
