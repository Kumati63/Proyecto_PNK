<?php

include("setup.php");

$rut = $_POST["rut"];
$email = $_POST["email"];
$telefono = $_POST["telefono"];
$nombre = $_POST["nombre"];
$contrasena = md5($_POST["contrasena"]);
$antecedentes = $_FILES['File']['name'];
$nacimiento = $_POST["nacimiento"];
$sexo = $_POST["sexo"];
$estado = 0;
$tipo_usuario = 3;


// echo $_FILES['File']['name']."<br>";
// echo $_FILES['File']['type']."<br>";
// echo $_FILES['File']['size']."<br>";
// echo $_FILES['File']['tmp_name']."<br>";
//CREAMOS LA CONSULTA PARA INGRESAR DATOS A LA DB
$sql = "INSERT INTO `usuarios` (`rut`, `email`, `telefono`, `nombre`, `contrasena`, `antecedentes`, `nacimiento`, `sexo`, `estado`, `id_tipo`) 
VALUES ('".$_POST["rut"]."', '".$_POST["email"]."','".$_POST["telefono"]."','".$_POST["nombre"]."','".$_POST["contrasena"]."', '".$_FILES['File']['name']."', 
        '".$_POST["nacimiento"]."', '".$_POST["sexo"]."', '$estado', '$tipo_usuario')";
        move_uploaded_file($_FILES['File']['tmp_name'], "../doc/Files_gestores/".$_FILES['File']['name']);



mysqli_query(conectar(),$sql);
header("Location:..\login.html");
