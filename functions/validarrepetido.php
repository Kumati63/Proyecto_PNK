<?php
include("setup.php");

if ((isset($_POST['email-usu']))){
    //VERIFICAR QUE NO SE REPITAN LOS CORREOS ELECTRONICOS
    $verificar_correo = "SELECT * FROM usuarios WHERE email='".$_POST['email-usu']."'";
    $result=mysqli_query(conectar(),$verificar_correo);
    $cont = mysqli_num_rows($result);

    echo $cont;
    //TERMINO DE VERIFICACION DE CORREOS
}else{
    //VERIFICAR QUE NO SE REPITAN LOS RUT
    $verificar_rut = "SELECT * FROM usuarios WHERE rut='".$_POST['rut-usu']."'";
    $result=mysqli_query(conectar(),$verificar_rut);
    $cont_rut = mysqli_num_rows($result);

    echo $cont_rut;
    //TERMINO DE VERIFICACION DE RUT
}


?>