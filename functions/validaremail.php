<?php
include("setup.php");

$verificar_correo = "SELECT * FROM usuarios WHERE email='".$_POST['email-usu']."' and estado=1";

//EJECUTAMOS LA QUERY
$result=mysqli_query(conectar(),$verificar_correo);

//  OBTENEMOS LSO DATOS DE LA TABLA
$datos=mysqli_fetch_array($result);

// MOSTRAR CANTIDAD DE RESULTADOS
$cont = mysqli_num_rows($result);

echo $cont;
?>