<?php

include('conector.php');



$con = new ConectorBD('localhost','root','');
$response['conexion'] = $con->initConexion('agenda_db');

if ($response['conexion']=='OK') {
//insertar primer dato
    $data['email'] = "blackredi80@gmail.com";
    $data['nombre'] = "Redi Echarri";
    $hash= password_hash("1234", PASSWORD_DEFAULT);
    $data['password'] = $hash;
    $data['fecha_nac'] = "1980/11/03";

  if($con->insertData('usuario', $data)){
    $response['msg']="exito en la insercion";
  }else {
    $response['msg']= "Hubo un error y los datos no han sido cargados";
  }


//insertar 2do dato
    $data['email'] = "lucerito129@hotmail.com";
    $data['nombre'] = "Luz Cerito";
    $hash= password_hash("1352", PASSWORD_DEFAULT);
    $data['password'] = $hash;
    $data['fecha_nac'] = "1990/09/14";

  if($con->insertData('usuario', $data)){
    $response['msg']="exito en la insercion";
  }else {
    $response['msg']= "Hubo un error y los datos no han sido cargados";
  }

  //insertar 3er dato
      $data['email'] = "Katylucas@gmail.com";
      $data['nombre'] = "Katy Anabel";
      $hash= password_hash("8760", PASSWORD_DEFAULT);
      $data['password'] = $hash;
      $data['fecha_nac'] = "1980/09/08";

    if($con->insertData('usuario', $data)){
      $response['msg']="exito en la insercion";
    }else {
      $response['msg']= "Hubo un error y los datos no han sido cargados";
    }


}else {
  $response['msg']= "No se pudo conectar a la base de datos";
}

echo json_encode($response);




 ?>
