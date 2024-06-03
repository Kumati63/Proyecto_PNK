<?php

include("setup.php");

switch($_POST['accion_btn']){
    
    case "Enviar": 
        Enviar();
        break;
    
    case "Modificar": 
        Modificar();
        break;
    
    case "Cancelar": 
        Cancelar();
        break;
}


if(isset($_GET['eliminar']))
{   if ($_GET['id']!=$_GET['id_usu']){
        $sql_eliminar = "DELETE FROM `usuarios` WHERE `usuarios`.`id_usuario` =".$_GET['id'];
        mysqli_query(conectar(),$sql_eliminar);
        header("Location:../menu_adm.php");
        exit;
    }else{
        $message = "No puedes eliminar el usuario que está en uso.";
        echo "<script type='text/javascript'>
            if (confirm('$message')) {
                window.location.href = '../menu_adm.php';
            } else {
                window.location.href = '../menu_adm.php';
            }
        </script>";
        exit;
}
    
}

function Enviar(){

    $sql_enviar = "INSERT INTO `usuarios` (`rut`, `email`, `telefono`, `nombre`, `contrasena`, `nacimiento`, `sexo`, `estado`, `id_tipo`) 
    VALUES ('".$_POST['rut']."', '".$_POST['email']."', ".$_POST['Telefono'].", '".$_POST['Nombre']."', '".md5($_POST['contrasena'])."',
            '".$_POST['nacimiento']."', '".$_POST['sexo']."', ".$_POST['estado'].", ".$_POST['tipo_usuario'].")";
    mysqli_query(conectar(),$sql_enviar);
    
    header("Location:../menu_adm.php");
    exit;
}

function Modificar(){
   
    $sql_modificar = "UPDATE `usuarios` SET `rut` = '".$_POST['rut']."', `email` = '".$_POST['email']."', `telefono` = ".$_POST['Telefono'].",
     `nombre` = '".$_POST['Nombre']."', `nacimiento` = '".$_POST['nacimiento']."', `sexo` = '".$_POST['sexo']."', `estado` = ".$_POST['estado'].", `id_tipo` = ".$_POST['tipo_usuario']." 
     WHERE `usuarios`.`id_usuario` = ".$_POST['get_id'];
    
    mysqli_query(conectar(),$sql_modificar);
    
    header("Location:../menu_adm.php");
    exit;
}

function Cancelar(){
    header("Location:../menu_adm.php");
    exit;
}

if ($_GET['estado']==1)
{    
    $sql="UPDATE `proyecto_pnk`.`usuarios` SET `estado`=0 WHERE `id_usuario`=".$_GET['id'];
    mysqli_query(conectar(),$sql);

    header("Location:../menu_adm.php");
}
else
{
    $sql="UPDATE `proyecto_pnk`.`usuarios` SET `estado`=1 WHERE `id_usuario`=".$_GET['id'];
    mysqli_query(conectar(),$sql);

    header("Location:../menu_adm.php");
}
?>