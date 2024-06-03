<?php

include("setup.php");

//CREAMOS LA CONSULTA
$sql="select * from usuarios where email='".$_POST['email']."' and contrasena='".md5($_POST['contrasena'])."' and estado=1";
//EJECUTAMOS LA QUERY
$result=mysqli_query(conectar(),$sql);

//  OBTENEMOS LSO DATOS DE LA TABLA
$datos=mysqli_fetch_array($result);

// MOSTRAR CANTIDAD DE RESULTADOS
$cont = mysqli_num_rows($result);

echo $sql;
echo $cont;
// SI HAY USUARIO, ENTRA AL MENU, AL CONTRARIO VUELVE AL  LOGIN
if($cont!=0)
{
    session_start();
    $_SESSION['usu']=$datos['nombre'];
    $_SESSION['tipo']=$datos['id_tipo'];
    $_SESSION['id_usuario']=$datos['id_usuario'];
    header("Location:..\menu.php");
}else{
    header("Location:..\login.html");
}

?>

