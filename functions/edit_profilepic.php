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

function Enviar(){

    echo $_FILES['File']['name']."<br>";
    echo $_FILES['File']['type']."<br>";
    echo $_FILES['File']['size']."<br>";
    echo $_FILES['File']['tmp_name']."<br>";

    if ($_FILES['File']['name'] == ""){
         
        $sql_enviar = "INSERT INTO `propiedades` (`Descripcion`, `Direccion`,`Precio`)
            VALUES ('".$_POST['Descripcion']."','".$_POST['Descripcion']."','".$_POST['Precio']."')";
    }else{
        $sql_enviar = "INSERT INTO `propiedades` (`imagenPrincipal`, `Descripcion`, `Direccion`,`Precio`)
            VALUES ('".$_FILES['File']['name']."','".$_POST['Descripcion']."','".$_POST['Descripcion']."','".$_POST['Precio']."')";
            move_uploaded_file($_FILES['File']['tmp_name'], "../img/fotos/".$_FILES['File']['name']);
    }
    echo $sql_enviar;
    die;
    mysqli_query(conectar(),$sql_enviar);
    header("Location:../Propiedades.php");
    exit;
}