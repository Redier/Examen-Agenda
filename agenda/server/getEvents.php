<?php
/*requerir el archivo conector.php*/
session_start();
require('./conector.php');
$con = new ConectorBD('localhost','root','');

//$response = array("msg" => $con->initConexion('agenda_db'),"eventos"=>[],
//"getData" => "");
$response ["msg"] = $con->initConexion('agenda_db');

if ($response['msg']=='OK') {
$resultado = $con->consultar(['eventos'],['*'], "WHERE fk_usuario ='".$_SESSION['username']."'",'');
/*Crear un arreglo asociativo con los objetos obtenidos*/
$i = 0;

/*Recorrer el arreglo de resultados*/
while($fila = $resultado->fetch_assoc()){
$response['eventos'][$i]['id']=$fila['id'];
$response['eventos'][$i]['title']=$fila['titulo'];
if ($fila['dia_completo'] == 0){ /*Verificar si el registro es fullday*/
  $allDay = false;
   /*Si no es full day, agregar hora de inicio al parametro start*/
  $response['eventos'][$i]['start']=$fila['fecha_ini'].'T'.$fila['hora_ini'];
  /*Si no es full day, agregar hora de inicio al parametro end*/
  $response['eventos'][$i]['end']=$fila['fecha_fin'].'T'.$fila['hora_fin'];
}else{
  $allDay= true;
   /*Si no es full day, no agregar la hora en el parametro start*/
  $response['eventos'][$i]['start']=$fila['fecha_ini'];
   /*Si no es full day, el parametro end debe ser vacio*/
  $response['eventos'][$i]['end']="";
}


$response['eventos'][$i]['allDay']=$allDay;
/*sumar 1 al contador*/
$i++;
}
/*Devolver respuesta positiva al obtener registros*/
$response['getData'] = "OK";
}
/*devolver el arreglo response en formato json*/
echo json_encode($response);

 ?>